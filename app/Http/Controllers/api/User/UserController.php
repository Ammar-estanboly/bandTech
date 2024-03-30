<?php

namespace App\Http\Controllers\api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserCreateRequest;
use App\Http\Requests\user\UserUpdateRequest;
use App\Http\Resources\user\UserResource;
use App\Models\users\User;
use App\Services\UserService;
use App\Traits\General\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;
    public function __construct(
      protected UserService $userService
    ) {
    }

    public function index() :JsonResponse
    {
       $users = $this->userService->all();

       return $this->formatResponse(true, $users,'users data',200,'' );
    }



    public function store(UserCreateRequest $request) :JsonResponse
    {

        $user = $this->userService->create($request);

        return $this->formatResponse(true,['user' => new UserResource($user)],'user created',201,'' );
    }

    public function show($id):JsonResponse
    {
        $user = $this->userService->find($id);
        return $this->formatResponse(true,['user' => new UserResource($user)],'user data',200,'' );
    }

    public function update(UserUpdateRequest $request, User $user) :JsonResponse
    {

        $user = $this->userService->update($request, $user);

        return $this->formatResponse(true,['user' => new UserResource($user)],'user updated',202,'' );
    }

    public function destroy(User $user)
    {
        $this->userService->delete($user);

        return $this->formatResponse(true,'','user deleted',200,'' );
    }
}
