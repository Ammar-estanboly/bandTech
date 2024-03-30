<?php

namespace App\Repositories\Interface;

use App\Models\users\User;

interface UserRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data,User $user);

    public function delete(User $user);

    public function find($id);
}
