<?php

namespace App\Services\Admin;

use Str;
use stdClass;
use Exception;
use App\Models\Product;
use App\Traits\ImageUploader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\Admin\AdminBaseService;
use App\Http\Requests\ProductFormRequest;

class ProductService extends AdminBaseService
{
    use ImageUploader;

    public function listProducts(int $perPage = 15): stdClass
    {
        $products = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return $this->successMsg('Products retrieved successfully', $products);
    }

    public function create(ProductFormRequest $request): stdClass
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'usage_instructions' => 'nullable|string',
            'dosage_info' => 'nullable|string',
            'safety_info' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku',
            'packaging_info' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        DB::beginTransaction();
        try {
            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $images[] = $this->uploadImaged($image, 'uploads/products');
                }
            }
            $validated['images'] = $images;

            Product::create($validated);
            DB::commit();

            return $this->successMsg('Product created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorMsg('Failed to create product: ' . $e->getMessage());
        }
    }

    public function update(ProductFormRequest $request, Product $product): stdClass
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'usage_instructions' => 'nullable|string',
            'dosage_info' => 'nullable|string',
            'safety_info' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'packaging_info' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        DB::beginTransaction();
        try {
            $images = $product->images ?? [];

            if ($request->filled('removed_images')) {
                $removed = json_decode($request->removed_images, true);
                $images = array_diff($images, $removed);

                foreach ($removed as $img) {
                    $path = str_replace('/storage/', '', parse_url($img, PHP_URL_PATH));
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $images[] = $this->uploadImaged($image, 'uploads/products');
                }
            }

            $validated['images'] = array_values($images);

            $product->update($validated);
            DB::commit();

            return $this->successMsg('Product updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorMsg('Failed to update product: ' . $e->getMessage());
        }
    }

    public function totalPublishedproducts(): int
    {
        return Product::where('is_active', true)->count();
    }

    public function totalRecords(): int
    {
        return Product::count();
    }

    public function delete(Product $product): stdClass
    {
        DB::beginTransaction();
        try {
            if ($product->images) {
                foreach ($product->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $product->delete();
            DB::commit();

            return $this->successMsg('Product deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorMsg('Failed to delete product: ' . $e->getMessage());
        }
    }
}