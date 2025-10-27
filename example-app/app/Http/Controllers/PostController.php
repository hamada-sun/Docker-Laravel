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


    public function update(Request $request, Post $post)
    // public function store(Request $request)
    {
        // dd(auth()->id());
        // $request->all();
        // dd($request->all());
        // $validated = $request->validate([
        //     'title' => 'required|max:20',
        //     'body' => 'required|max:400',
        // ]);

        // Post::create([
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     'user_id' => auth()->id() ?? 1, // ※本当は0はダメ。nullableにしてNULL許容 or ログイン必須にすること
        //     // ← ログイン中のユーザーIDをセット
        // ]);

        // Gate::authorize('test');//Sec9-3 IDによる投稿機能制限

        $validated = $request->validate([
        'title' => 'required|max:20',
        'body' => 'required|max:400',
        ]);

        // **ここが追加・変更**
        $validated['user_id'] = auth()->id();// ?? 1;  // user_id をバリデーション済みデータに追加
        //Post::create($validated); // **ここが重要**: バリデーション済みデータを直接渡す
        // $post = Post::create($validated);

        $post->update($validated);

        $request->session()->flash('message', '更新しました');

        return back();//->with('message', '保存しました');
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
    //
}
