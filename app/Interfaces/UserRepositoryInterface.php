<?php

namespace App\Interfaces;


use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getAllUsers(Request $request);
    public function showUser($user_id);
    public function deleteUser($user_id);
    public function changeRoleUser($user_id);
}
