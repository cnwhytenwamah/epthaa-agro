<?php

namespace App\Http\Controllers\FrontPages;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class CartController extends BaseController
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = array_sum(array_map(
            fn ($item) => $item['price'] * $item['quantity'],
            $cart
        ));

        return view('front-pages.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1'
        ]);

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $qty = $request->quantity ?? 1;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->images[0] ?? null,
                'quantity' => $qty,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * 🔥 AUTO-SYNC CART UPDATE (AJAX)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart'
            ], 404);
        }

        $cart[$id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);

        $itemSubtotal = $cart[$id]['price'] * $cart[$id]['quantity'];
        $cartTotal = array_sum(array_map(
            fn ($item) => $item['price'] * $item['quantity'],
            $cart
        ));

        return response()->json([
            'success'        => true,
            'item_subtotal' => $itemSubtotal,
            'cart_total'    => $cartTotal
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}