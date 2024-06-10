<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use Inertia\Inertia;



class PostController extends Controller
{
    public function index()
    {
        $response = Http::get(env('API_URL'));
        $posts = $response->json();

        return Inertia::render('Post/Index', compact('posts'));
    }

    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'keywords' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $response = Http::post(env('API_URL'), $validatedData);

        if ($response->successful()) {
            return redirect()->route('post.index')->with('success', 'Post creado con éxito.');
        } else {
            return redirect()->route('post.create')->withErrors('Error al crear el post.');
        }
    }

}
