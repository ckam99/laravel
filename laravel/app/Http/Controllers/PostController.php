<?php

namespace App\Http\Controllers;

use App\Jobs\PostCreated;
use App\Jobs\PostUpdated;
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
        PostCreated::dispatch($post);
        return response($post, 201);
    }

    public function show(int $id)
    {
        $post = Post::find($id);
        return response($post);
    }

    public function update(Request $request, int $id)
    {
        $post = Post::find($id);
        $post->update($request->only('title', 'body'));
        PostUpdated::dispatch($post);
        return response($post);
    }

    public function destroy(Request $request, int $id)
    {
        $post = Post::find($id);
        $post->delete();
        PostUpdated::dispatch($post->id);
    }
}
