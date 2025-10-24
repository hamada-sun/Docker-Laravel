<?php

namespace App\Http\Controllers;

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


        $validated = $request->validate([
        'title' => 'required|max:20',
        'body' => 'required|max:400',
        ]);

        // **ここが追加・変更**
        $validated['user_id'] = auth()->id() ?? 1;  // user_id をバリデーション済みデータに追加

        Post::create($validated); // **ここが重要**: バリデーション済みデータを直接渡す


        // $post = Post::create($validated);

        $request->session()->flash('message', '保存しました');

        return back();//->with('message', '保存しました');
    }

    public function index(){
        // $posts = Post::all();
        $posts = Post::with('user')->get();
        return view('post.index', compact('posts'));
    }
    //
}
