<?php

namespace App\Http\Controllers\FrontPages;

use Exception;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Services\Payments\PaymentService;

class CheckoutController extends BaseController
{
    public function __construct(protected PaymentService $paymentService) {}

    // Show checkout page
    public function index()
    {
        $states = [
            'Abia','Adamawa','Akwa Ibom','Anambra','Bauchi','Bayelsa','Benue','Borno',
            'Cross River','Delta','Ebonyi','Edo','Ekiti','Enugu','Gombe','Imo',
            'Jigawa','Kaduna','Kano','Katsina','Kebbi','Kogi','Kwara','Lagos',
            'Nasarawa','Niger','Ogun','Ondo','Osun','Oyo','Plateau','Rivers',
            'Sokoto','Taraba','Yobe','Zamfara','FCT (Abuja)'
        ];

        $cart = session()->get('cart');
        if (empty($cart)) return redirect()->route('shop.index')->with('error', 'Your cart is empty!');

        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $deliveryFee = 2000;
        $total = $subtotal + $deliveryFee;

        return view('front-pages.checkout.index', compact('cart', 'subtotal', 'deliveryFee', 'total', 'states'));
    }

    // Process checkout
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
        if (empty($cart)) return redirect()->route('shop.index')->with('error', 'Your cart is empty!');

        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $deliveryFee = 2000;
        $total = $subtotal + $deliveryFee;

        DB::beginTransaction();

        try {
            
            // Create Order
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
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'payment_reference' => Str::random(12),
            ]);

            // Create Order Items
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Reduce stock
                $product = Product::find($productId);
                $product?->decrement('stock_quantity', $item['quantity']);
            }

            DB::commit();
            session()->forget('cart'); // Clear cart

            // Handle payment method
            if ($validated['payment_method'] === 'cash') {
                return redirect()->route('checkout.success', $order->order_number)
                                 ->with('success', 'Order placed! Pay on delivery.');
            }
            
            // Paystack / Flutterwave
            $initiatePayment =  $this->paymentService->initialize($order);
            dd($initiatePayment);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }

    // Success page
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();
        return view('front-pages.checkout.success', compact('order'));
    }

    // Optional: Paystack callback if you want to handle from this controller
    public function paystackCallback(Request $request)
    {
        $paymentController = app(PaymentController::class);
        return $paymentController->verifyPayment($request);
    }
}
