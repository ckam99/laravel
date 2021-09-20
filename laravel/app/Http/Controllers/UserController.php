<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use App\Jobs\UserCreated;
use App\Jobs\UserDeleted;
use App\Jobs\UserUpdated;
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
        UserCreated::dispatch($user);
        return response($user, 201);
    }


    public function show(int $id)
    {
        $user = User::find($id);
        return response($user);
    }

    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        $user->update($request->only('title', 'body'));
        UserUpdated::dispatch($user);
        return response($user);
    }

    public function destroy(Request $request, int $id)
    {
        $user = User::find($id);
        $user->delete();
        UserDeleted::dispatch($user->id);
    }
}
