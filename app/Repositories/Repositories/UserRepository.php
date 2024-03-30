<?php

namespace App\Repositories\Repositories;

use App\Models\users\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function all() :LengthAwarePaginator
    {
        return User::paginate(3);
    }

    public function create(array $data) :User
    {
        return User::create($data);
    }

    public function update(array $data,User $user): User
    {

        $user->update($data);
        return $user;
    }

    public function delete(User $user):bool
    {

        $user->delete();
        return true;
    }

    public function find(  $id) :User
    {
        return User::findOrFail($id);
    }
}
