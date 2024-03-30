<?php

namespace Tests\Feature\Http\Controllers\api\User;

use App\Http\Controllers\api\User\UserController;
use App\Http\Requests\user\UserCreateRequest;
use App\Http\Resources\user\UserResource;
use App\Models\users\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase; // Ensure a clean database for each test

    public function test_index_returns_all_users()
    {
        $users = User::factory()->count(3)->create();
        $users = User::paginate(3);
        $userService = Mockery::mock(UserService::class);
        $userService->shouldReceive('all')->once()->andReturn($users);

        $controller = new UserController($userService);

        $response = $controller->index();


        $this->assertEquals(200, $response->getStatusCode());
    }




    public function test_show_returns_user_resource_for_found_user()
{
    $user = User::factory()->create();
    $userService = Mockery::mock(UserService::class);
    $userService->shouldReceive('find')->with($user->id)->once()->andReturn($user);

    $controller = new UserController($userService);

    $response = $controller->show($user->id);

    $this->assertEquals(200, $response->getStatusCode());
}






public function test_destroy_deletes_user_and_returns_response()
{
    $user = User::factory()->create();
    $userService = Mockery::mock(UserService::class);
    $userService->shouldReceive('delete')->with($user)->once();

    $controller = new UserController($userService);

    $response = $controller->destroy($user);

    // ...assertions for successful response...
    $this->assertEquals(200, $response->getStatusCode());
}


}
