<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserRegisterRequest;
use App\Http\Resources\user\UserResource;
use App\Models\users\User;
use App\Traits\General\FileManagerTrait;
use App\Traits\General\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use FileManagerTrait, ResponseTrait;

    /**
     * Handles user registration requests.
     *
     * @param UserRegisterRequest $request Validated user registration data
     * @return UserResource
     */
    public function register(UserRegisterRequest $request) :JsonResponse
    {
        // Prepare user data based on presence of avatar
        $userData = $this->prepareUserData($request);

        // Create and save the user to the database
        $user = User::create($userData);

        // Format and return a successful response with user resource
        return $this->formatResponse(
            true,
            new UserResource($user),
            'User registered successfully',
            201,
            ''
        );
    }

    /**
     * Prepares user data for saving based on whether an avatar is included.
     *
     * @param UserRegisterRequest $request Validated user registration data
     * @return array Prepared user data
     */
    private function prepareUserData(UserRegisterRequest $request): array
    {
        if ($this->requestHasAvatar($request)) {
            return $this->dataWithAvatar($request);
        } else {
            return $this->dataWithoutAvatar($request);
        }
    }

    /**
     * Checks if the request includes an avatar file.
     *
     * @param UserRegisterRequest $request Validated user registration data
     * @return bool True if avatar is present, false otherwise
     */
    private function requestHasAvatar(UserRegisterRequest $request): bool
    {
        return isset($request->avatar);
    }

    /**
     * Prepares user data with avatar processing and storage.
     *
     * @param UserRegisterRequest $request Validated user registration data
     * @return array User data with avatar path
     */
    private function dataWithAvatar(UserRegisterRequest $request): array
    {
        // Upload the avatar and store the path in the 'avatar' field
        return [
            'name' => $request->name,
            'password' => $request->password, // Use bcrypt for password hashing in model setter
            'is_active' => true,
            'email' => $request->email,
            'avatar' => $this->uploadFile($request->avatar, 'users/avatars'),
        ];
    }

    /**
     * Prepares user data without avatar processing.
     *
     * @param UserRegisterRequest $request Validated user registration data
     * @return array User data without avatar field
     */
    private function dataWithoutAvatar(UserRegisterRequest $request): array
    {
        return [
            'name' => $request->name,
            'password' => $request->password, // Use bcrypt for password hashing in model setter
            'is_active' => true,
            'email' => $request->email,
        ];
    }
}

