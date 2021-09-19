<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response(Post::all());
    }

    public function create(Request $request)
    {
        $post = Post::create($request->all());
        dispatch(new TestJob);
        return response($post, 201);
    }
}
