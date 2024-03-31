<?php

namespace App\Http\Controllers\api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\product\ProductResource;
use App\Models\products\Product;
use App\Models\users\User;
use App\Services\ProductService;
use App\Traits\General\ResponseTrait;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    use ResponseTrait;
    public function __construct(
      protected ProductService $productService
    ) {
    }

    public function index() :JsonResponse
    {
       $products = $this->productService->all();

       return $this->formatResponse(true, $products,'products data',200,'' );
    }



    public function store(ProductCreateRequest $request) :JsonResponse
    {

        $product = $this->productService->create($request);

        return $this->formatResponse(true,['product' => new ProductResource($product)],'product created',201,'' );
    }

    public function show($id):JsonResponse
    {
        $product = $this->productService->find($id);
        return $this->formatResponse(true,['product' => new ProductResource($product)],'product data',200,'' );
    }

    public function update(ProductUpdateRequest $request, Product $product) :JsonResponse
    {

        $product = $this->productService->update($request, $product);

        return $this->formatResponse(true,['product' => new ProductResource($product)],'product updated',202,'' );
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return $this->formatResponse(true,'','Product deleted',200,'' );
    }
}
