<?php

namespace App\Repositories\Repositories;

use App\Models\products\Product;
use App\Repositories\Interface\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function all() :LengthAwarePaginator
    {
        return Product::isActive()->paginate(3);
    }

    public function create(array $data) :Product
    {
        return Product::create($data);
    }

    public function update(array $data,Product $product): Product
    {

        $product->update($data);
        return $product;
    }

    public function delete(Product $product):bool
    {

        $product->delete();
        return true;
    }

    public function find($id) :Product
    {
        return Product::findOrFail($id);
    }
}
