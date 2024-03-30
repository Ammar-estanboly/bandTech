<?php

namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Http\Controllers\api\auth\RegisterController;
use App\Http\Requests\user\UserRegisterRequest;
use App\Http\Resources\user\UserResource;
use App\Models\users\User;
use App\Services\UserService;
use App\Traits\General\FileManagerTrait;
use App\Traits\General\ResponseTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase; // This trait helps ensure a clean database for each test

    public function test_register_creates_user_and_returns_status_code_201()
    {


        $response = $this->post('/api/register', [
            'name' => 'John Doe',
            'username' =>'ammar',
            'email' => 'john.doe@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData['status_code'],201);

    }






}
