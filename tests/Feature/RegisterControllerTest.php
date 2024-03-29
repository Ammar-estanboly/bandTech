<?php

namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Http\Controllers\api\auth\RegisterController;
use App\Http\Requests\user\UserRegisterRequest;
use App\Models\users\User;
use App\Traits\General\FileManagerTrait;
use App\Traits\General\ResponseTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase; // Clears database after each test

    // public function test_register_with_avatar_successful()
    // {
    //     // Mock FileManagerTrait methods
    //     $mockFileManager = Mockery::mock(FileManagerTrait::class);
    //     $mockFileManager->shouldReceive('uploadFile')->once()->andReturn('path/to/avatar.jpg');

    //     $this->app->instance(FileManagerTrait::class, $mockFileManager);

    //     $data = [
    //         'name' => 'John Doe',
    //         'email' => 'john.doe@example.com',
    //         'password' => 'secret123',
    //         'avatar' => UploadedFile::fake()->image('avatar.jpg'),
    //     ];

    //     $request = new UserRegisterRequest($data);

    //     $controller = new RegisterController();
    //     $response = $controller->register($request);

    //     $responseData = json_decode($response->getContent(), true);

    //     $this->assertEquals($responseData['status_code'],201);
    //     $this->assertEquals($responseData['message'], 'User registered successfully');

    //     $user = User::first();
    //     $this->assertEquals($data['name'], $user->name);
    //     $this->assertEquals($data['email'], $user->email);
    //     $this->assertTrue(Hash::check($data['password'], $user->password));
    //  //   $this->assertEquals($data['avatar'], $user->avatar);

    //    // Storage::disk('public')->assertExists( $user->avatar); // Check avatar storage
    // }

    public function test_register_without_avatar_successful()
    {
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'password' => 'secret456',
        ];

        $request = new UserRegisterRequest($data);

        $controller = new RegisterController();
        $response = $controller->register($request);
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData['status_code'],201);
        $this->assertEquals($responseData['message'], 'User registered successfully');

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
        $this->assertTrue(Hash::check($data['password'], $user->password));
        $this->assertEquals($user->avatar,asset('images/default-avatar.png')); // No avatar expected
    }

    // public function test_register_with_invalid_data_fails()
    // {
    //     $data = [
    //         'name' => '', // Empty name
    //         'email' => 'invalid_email',
    //         'password' => 'short', // Password less than minimum length
    //     ];

    //     $request = new UserRegisterRequest($data);

    //     $controller = new RegisterController();
    //     $response = $controller->register($request);

    //     $responseData = json_decode($response->getContent(), true);
    //     $this->assertEquals($responseData['success'], false);
    //     $this->assertEquals($responseData['status_code'],422);// Unprocessable Entity (validation error)


    // }
}
