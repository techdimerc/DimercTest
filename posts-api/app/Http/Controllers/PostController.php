<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->keywords = $request->input('keywords');
        $post->body = $request->input('body');
        $post->save();

        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->keywords = $request->input('keywords');
        $post->body = $request->input('body');
        $post->save();

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(null, 204);
    }
}
