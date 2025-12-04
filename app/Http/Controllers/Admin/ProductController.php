<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\Admin\ProductService;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductFormRequest;

class ProductController extends BaseController
{
    public function __construct(protected ProductService $productService){}

    public function index(): View
    {
        $response = $this->productService->listProducts();
        $products = $response->data;

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductFormRequest $request): RedirectResponse
    {
        $response = $this->productService->create($request);

        if (!$response->status) {
            return redirect()->back()->withErrors($response->message);
        }
        return redirect()->route('admin.products.index')->with('success', $response->message);
    }

    public function edit(Product $product): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $response = $this->productService->update($request, $product);

        if (!$response->status) {
            return redirect()->back()->withErrors($response->message);
        }
        return redirect()->route('admin.products.index')->with('success', $response->message);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $response = $this->productService->delete($product);

        if (!$response->status) {
            return redirect()->back()->withErrors($response->message);
        }
        return redirect()->route('admin.products.index')->with('success', $response->message);
    }
}