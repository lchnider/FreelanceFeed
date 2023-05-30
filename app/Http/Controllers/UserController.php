<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with(['works', 'skills'])->findOrFail($id);
        return new UserResource($user);
    }
}
