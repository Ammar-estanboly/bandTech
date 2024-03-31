<?php

namespace App\Services;

use App\Models\products\Product;
use App\Repositories\Interface\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Traits\General\FileManagerTrait;
use Illuminate\Pagination\LengthAwarePaginator;


class ProductService
{
    use FileManagerTrait;
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }
//
    public function create(Request $request) : Product
    {
        $data = $this->prepareCreateProductData($request);
        return $this->productRepository->create($data);
    }



    public function update(Request $request, Product $product): Product
    {
        $data = $this->prepareUpdateProductData($request, $product);
        return $this->productRepository->update($data, $product);
    }

    public function delete(Product $product): bool
    {
        if($this->ProductHasImage( $product)){
            $this->deleteFile($product->image);
        }
        return $this->productRepository->delete($product);
    }

    public function all(): LengthAwarePaginator
    {
        //show price  according user type
        $products = $this->productRepository->all();
        foreach( $products as $product){
            $this->ShowProductPriceAccordingUserType($product);
        }
        return  $products ;
    }

     public function find(int $id): Product
    {

        return $this->ShowProductPriceAccordingUserType( $this->productRepository->find($id) );
    }


            /**
     * Show each type of user different product prices according  type.
     *
     * @param Product
     * @return Product with price according user type
     */
    private function ShowProductPriceAccordingUserType(Product $product): Product
    {
        //get user type
        $type = auth()->user()->type;
       $product->price = collect($product->price)[$type];
       return $product;
    }


    /**
     * check if product has image.
     *
     * @param Product
     * @return boolean true if has image false if image default
     */
    private function ProductHasImage(Product $product): bool
    {
        return ! ($product->image == asset('images/default-product.png') );

    }



        /**
     * Prepares product data for saving based on whether an avatar is included.
     *
     * @param Request $request Validated product data
     * @return array Prepared product data
     */
    private function prepareCreateProductData(Request $requset): array
    {
        $data = [
            'name'   => $requset->name,
            'description'=>$requset->description,
            'price'     =>$requset->price,
            'is_active'=>(bool) $requset->is_active,
            'slug'      =>$requset->slug,
        ];

        if ($this->requestHasImage($requset)) {
            $data['image'] = $this->uploadFile($requset->image, 'products/images');
        }

        return $data;
    }




        /**
     * Checks if the request includes an avatar file.
     *
     * @param requset $request Validated user  data
     * @return bool True if avatar is present, false otherwise
     */
    private function requestHasImage(Request $request): bool
    {
        return isset($request->image);
    }




        /**
     * Prepares prduct data for saving based on whether an avatar is included.
     *
     * @param Request $request Validated product data
     * @return array Prepared product data
     */
    private function prepareUpdateProductData(Request $request,Product $product): array
    {
        $data = [
            'name' => $request->filled('name') ? $request->name : $product->name,
            'description' =>$request->filled('description') ? $request->description : $product->description ,
            'price' => $request->filled('price') ? $request->price: $product->price,
            'slug' => $request->filled('slug') ? $request->slug: $product->slug,
            'is_active' => $request->filled('is_active') ? (bool)$request->is_active: $product->is_active,



        ];

        if ($this->requestHasImage($request)) {
            $data['image'] = $this->fileManage($product->image, $request->image, 'products/images');
        }



        return $data;
    }








}
