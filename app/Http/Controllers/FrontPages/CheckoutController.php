<?php

namespace App\Http\Controllers\FrontPages;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class CheckoutController extends BaseController
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty!');
        }

        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $deliveryFee = 2000; // Fixed delivery fee
        $total = $subtotal + $deliveryFee;

        return view('front-pages.checkout.index', compact('cart', 'subtotal', 'deliveryFee', 'total'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'delivery_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'payment_method' => 'required|in:paystack,flutterwave,cash',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty!');
        }

        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $deliveryFee = 2000;
        $total = $subtotal + $deliveryFee;

        DB::beginTransaction();
        
        try {
            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'delivery_address' => $validated['delivery_address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_method'] === 'cash' ? 'pending' : 'pending',
                'order_status' => 'pending',
            ]);

            // Create order items
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Update product stock
                $product = Product::find($productId);
                $product->decrement('stock_quantity', $item['quantity']);
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');

            // Redirect based on payment method
            if ($validated['payment_method'] === 'paystack') {
                return $this->initializePaystack($order);
            } elseif ($validated['payment_method'] === 'flutterwave') {
                return $this->initializeFlutterwave($order);
            } else {
                return redirect()->route('checkout.success', $order->order_number)
                    ->with('success', 'Order placed successfully! Pay on delivery.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Order processing failed: ' . $e->getMessage());
        }
    }

    private function initializePaystack($order)
    {
        $paystack = new \Unicodeveloper\Paystack\Paystack();
        
        $data = [
            'amount' => $order->total * 100, 
            'email' => $order->customer_email,
            'reference' => $order->order_number,
            'callback_url' => route('checkout.paystack.callback'),
            'metadata' => json_encode(['order_id' => $order->id])
        ];

        try {
            return $paystack->getAuthorizationUrl($data)->redirectNow();
        } catch (\Exception $e) {
            return back()->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function paystackCallback(Request $request)
    {
        $paystack = new \Unicodeveloper\Paystack\Paystack();
        $paymentDetails = $paystack->getPaymentData();

        $order = Order::where('order_number', $paymentDetails['data']['reference'])->first();

        if ($paymentDetails['data']['status'] === 'success') {
            $order->update([
                'payment_status' => 'paid',
                'payment_reference' => $paymentDetails['data']['reference'],
                'order_status' => 'processing'
            ]);

            return redirect()->route('checkout.success', $order->order_number)
                ->with('success', 'Payment successful! Your order is being processed.');
        }

        return redirect()->route('checkout.index')
            ->with('error', 'Payment verification failed.');
    }

    private function initializeFlutterwave($order)
    {
        $data = [
            'tx_ref' => $order->order_number,
            'amount' => $order->total,
            'currency' => 'NGN',
            'payment_options' => 'card,banktransfer,ussd',
            'redirect_url' => route('checkout.flutterwave.callback'),
            'customer' => [
                'email' => $order->customer_email,
                'phone_number' => $order->customer_phone,
                'name' => $order->customer_name
            ],
            'customizations' => [
                'title' => 'EPTHAA AGRO LIMITED',
                'description' => 'Order ' . $order->order_number,
            ]
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('FLUTTERWAVE_SECRET_KEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);

        if ($result['status'] === 'success') {
            return redirect($result['data']['link']);
        }

        return back()->with('error', 'Payment initialization failed.');
    }

    public function flutterwaveCallback(Request $request)
    {
        $transactionId = $request->transaction_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$transactionId}/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('FLUTTERWAVE_SECRET_KEY')
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);

        if ($result['status'] === 'success' && $result['data']['status'] === 'successful') {
            $order = Order::where('order_number', $result['data']['tx_ref'])->first();
            
            $order->update([
                'payment_status' => 'paid',
                'payment_reference' => $transactionId,
                'order_status' => 'processing'
            ]);

            return redirect()->route('checkout.success', $order->order_number)
                ->with('success', 'Payment successful!');
        }

        return redirect()->route('front-pages.checkout.index')->with('error', 'Payment verification failed.');
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();
        return view('front-pages.checkout.success', compact('order'));
    }
}