<?php

namespace App\Repositories\Interface;

interface CategoryRepositoryInterface
{
    public function all();
    public function paginate($perPage = 15);
    public function find($id);
    public function findBySlug($slug);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getActive();
    public function getWithProductCount();
    public function search($search);
}
