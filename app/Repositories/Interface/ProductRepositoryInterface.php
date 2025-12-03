<?php

namespace App\Repositories\Interface;

interface ProductRepositoryInterface
{
    public function all();
    public function paginate($perPage = 15);
    public function find($id);
    public function findBySlug($slug);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getActive();
    public function getFeatured($limit = null);
    public function search(array $filters);
    public function getByCategory($categoryId);
    public function getLowStock($threshold = 10);
    public function updateStock($id, $quantity);
}
