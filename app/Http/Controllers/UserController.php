<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Resources\User\UserCollection;
use App\Resources\User\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repostory;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return new UserCollection($this->repository->getAllUsers($request));
    }

    public function show($id)
    {
        return new UserResource($this->repository->showUser($id));
    }

    public function delete($id)
    {
        $this->repository->deleteUser($id);
        return response()->successJson();
    }
}
