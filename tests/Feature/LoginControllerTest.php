<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\api\auth\LoginController;
use Tests\TestCase;
use App\Models\users\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase; // Reset database after each test

    /**
     * Test successful login with valid credentials.
     */
    public function test_successful_login()
    {
        $user = User::create([
            'name' =>'ammar',
            'email' =>'ammar@gmail.com',
            'is_active' =>true,
            'password' =>'password123'
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password123'
        ]);

        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData['status_code'],200);


    }

    /**
     * Test login failure with invalid email.
     */
    public function test_login_fails_with_invalid_email()
    {
        $response = $this->post('/api/login', [
            'email' => 'invalid@email.com',
            'password' => 'anypassword'
        ]);


        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData['status_code'],401);

        $response->assertStatus(401);

    }

    /**
     * Test login failure with invalid password.
     */
    public function test_login_fails_with_invalid_password()
    {
        $user = User::create([
            'name' =>'ammar',
            'email' =>'ammar@gmail.com',
            'is_active' =>true,
            'password' =>'password123'
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'wrongpassword'
        ]);
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData['status_code'],401);

    }




}
