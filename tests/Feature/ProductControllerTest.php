<?php

namespace Tests\Feature\Http\Controllers\Api\Product;

use App\Http\Controllers\api\Product\ProductController;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\products\Product;
use App\Models\users\User;
use App\Services\ProductService;
use App\Traits\General\ResponseTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

use Mockery;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected ProductService $productServiceMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productServiceMock = Mockery::mock(ProductService::class);
        $this->app->instance(ProductService::class, $this->productServiceMock);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }



    public function test_index_returns_all_products()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $products = [Product::factory(3)->create()->toArray()]; // Create 3 dummy products
        $products = new LengthAwarePaginator($products, 3, 1);

        $this->productServiceMock->shouldReceive('all')
            ->once()
            ->andReturn($products);

        $response = $this->getJson('/api/get-products');

        $response->assertStatus(200);

        // $this->assertCount(3, $response->json('data'));
    }




    public function test_store_creates_product_and_returns_status_code()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => ['normal' => 100, 'gold' => 200,'silver'=>190], // Ensures correct price format
            'slug' => $this->faker->unique()->slug,
            'is_active' => true,
        ];

        $product = new Product($data);


        $this->productServiceMock->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($request) use ($data) {
                return $request->all() === $data;
            }))
            ->andReturn($product);

        $request = new ProductCreateRequest();
        $request->merge($data);

        $response = $this->postJson('/api/product/store', $request->toArray());

        $response->assertStatus(201);

    }




}
