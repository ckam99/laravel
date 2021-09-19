<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response(User::all());
    }

    public function create(Request $request)
    {
        $user = User::create($request->all());
        dispatch(new TestJob);
        return response($user, 201);
    }
}
