<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|max:20',
        'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();  // user_id をバリデーション済みデータに追加
        //Post::create($validated); // **ここが重要**: バリデーション済みデータを直接渡す
        $post = Post::create($validated);
        $request->session()->flash('message', '保存しました');

        return back();//->with('message', '保存しました');
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
        'title' => 'required|max:20',
        'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();
        $post->update($validated);
        $request->session()->flash('message', '更新しました');

        return back();
    }

    public function index(){
        // $posts = Post::all();
        $posts = Post::with('user')->get();
        return view('post.index', compact('posts'));
    }

    public function show (Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function destroy(Request $request, Post $post)
    {
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('post.index');
    }
    //
}
