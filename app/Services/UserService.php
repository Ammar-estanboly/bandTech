<?php

namespace App\Services;

use App\Models\users\User;
use Illuminate\Http\Request;

use App\Repositories\Interface\UserRepositoryInterface;
use App\Traits\General\FileManagerTrait;
use Illuminate\Pagination\LengthAwarePaginator;


class UserService
{
    use FileManagerTrait;
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }
//
    public function create(Request $request) : User
    {
        $data = $this->prepareCreateUserData($request);
        return $this->userRepository->create($data);
    }

    public function register(Request $request) : User
    {
        $data = $this->prepareRegisterUserData($request);
        return $this->userRepository->create($data);
    }

    public function update(Request $request, User $user): User
    {
        $data = $this->prepareUpdateUserData($request, $user);
        return $this->userRepository->update($data, $user);
    }

    public function delete(User $user): bool
    {

        $this->deleteFile($user->avatar);
        return $this->userRepository->delete($user);
    }

    public function all(): LengthAwarePaginator
    {
        return $this->userRepository->all();
    }

     public function find(int $id): User
    {
        return $this->userRepository->find($id);
    }




        /**
     * Prepares user data for saving based on whether an avatar is included.
     *
     * @param Request $request Validated user data
     * @return array Prepared user data
     */
    private function prepareCreateUserData(Request $request): array
    {
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'type' =>$request->type ,
            'email' => $request->email,
            'is_active' => ($request->is_active)?$request->is_active:true,
            'password' => $request->password, // Use bcrypt for password hashing in model setter
        ];

        if ($this->requestHasAvatar($request)) {
            $data['avatar'] = $this->uploadFile($request->avatar, 'users/avatars');
        }

        return $data;
    }



            /**
     * Prepares register user data for saving based on whether an avatar is included.
     * add more security to prevent update column that not have accsess
     * @param Request $request Validated user data
     * @return array Prepared user data
     */
    private function prepareRegisterUserData(Request $request): array
    {
        $userData = $request->only([ 'name',  'username', 'email', 'password']);
        $data = [
            'name' => $userData['name'],
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => $userData['password'], // Use bcrypt for password hashing in model setter
            'is_active' =>true,
        ];

        if ($this->requestHasAvatar($request)) {
            $data['avatar'] = $this->uploadFile($request->avatar, 'users/avatars');
        }

        return $data;
    }
        /**
     * Checks if the request includes an avatar file.
     *
     * @param requset $request Validated user  data
     * @return bool True if avatar is present, false otherwise
     */
    private function requestHasAvatar(Request $request): bool
    {
        return isset($request->avatar);
    }




        /**
     * Prepares user data for saving based on whether an avatar is included.
     *
     * @param Request $request Validated user data
     * @return array Prepared user data
     */
    private function prepareUpdateUserData(Request $request,User $user): array
    {
        $data = [
            'name' => $request->filled('name') ? $request->name : $user->name,
            'type' =>$request->filled('type') ? $request->type : $user->type ,
            'username' => $request->filled('username') ? $request->username: $user->username,
            'email' => $request->filled('email') ? $request->email : $user->email,
            'is_active' => $request->filled('is_active') ? $request->is_active : $user->is_active,
        ];

        if ($this->requestHasAvatar($request)) {
            $data['avatar'] = $this->fileManage($user->avatar, $request->avatar, 'users/avatars');
        }

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        return $data;
    }








}
