<?php

namespace App\Repositories;

use App\Filters\UserFilter;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(Request $request)
    {
        $users = new UserFilter(User::class, $request->all());
        return $users->filter()->paginate(10);
    }

    public function showUser($user_id)
    {
        return User::find($user_id);
    }

    public function deleteUser($user_id)
    {
        return User::destroy($user_id);
    }

    public function changeRoleUser($user_id)
    {
        // TODO: Implement changeRoleUser() method.
    }
}
