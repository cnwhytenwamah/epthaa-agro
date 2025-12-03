<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('category')->get();
    }

    public function paginate($perPage = 15)
    {
        return $this->model->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->with('category')->findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return $this->model->with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->find($id);
        return $product->delete();
    }

    public function getActive()
    {
        return $this->model->where('is_active', true)->with('category')->get();
    }

    public function getFeatured($limit = null)
    {
        $query = $this->model->where('is_featured', true)
            ->where('is_active', true);
        
        if ($limit) {
            $query->take($limit);
        }
        
        return $query->get();
    }

    public function search(array $filters)
    {
        $query = $this->model->where('is_active', true)->with('category');

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        return $query->paginate(12);
    }

    public function getByCategory($categoryId)
    {
        return $this->model->where('category_id', $categoryId)
            ->where('is_active', true)
            ->get();
    }

    public function getLowStock($threshold = 10)
    {
        return $this->model->where('stock_quantity', '<', $threshold)->get();
    }

    public function updateStock($id, $quantity)
    {
        $product = $this->find($id);
        $product->decrement('stock_quantity', $quantity);
        return $product;
    }
}
