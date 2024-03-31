<?php

namespace App\Repositories\Interface;

use App\Models\products\Product;
use App\Models\users\User;

interface ProductRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data,Product $product);

    public function delete(Product $product);

    public function find($id);
}
