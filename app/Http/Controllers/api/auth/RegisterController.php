<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserRegisterRequest;
use App\Http\Resources\user\UserResource;
use App\Models\users\User;
use App\Services\UserService;
use App\Traits\General\FileManagerTrait;
use App\Traits\General\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use FileManagerTrait, ResponseTrait;

    public function __construct(
        protected UserService $userService
      ) {
      }

    /**
     * Handles user registration requests.
     *
     * @param UserRegisterRequest $request Validated user registration data
     * @return UserResource
     */
    public function register(UserRegisterRequest $request)  :JsonResponse
    {


        $user = $this->userService->register($request);

        // Format and return a successful response with user resource
        return $this->formatResponse(
            true,
            new UserResource($user),
            'User registered successfully',
            201,
            ''
        );
    }


}

