<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Symfony\Component\HttpKernel\HttpCache\SubRequestHandler;

class PostController extends Controller
{
    public function create() {
        return view('post.create');
    }

    public function store(Request $request) {
        // $post = Post::create([
        //     'title' => $request->title,
        //     'body' => $request->body,
        // ]);

        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        $request->session()->flash('message', '保存しました');
        return back();
    }

    public function index() {
        $posts=Post::all();
        return view('post.index', compact('posts'));
    }
    //
}
