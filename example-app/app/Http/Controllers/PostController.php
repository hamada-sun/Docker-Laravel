<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Symfony\Component\HttpKernel\HttpCache\SubRequestHandler;
// use Illuminate\Support\Facades\DB; //p.227 queryBuilder

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
        // $posts=Post::all();

        $posts = Post::with('user')->get();

        // $posts = DB::table('posts')->get();//p.227 queryBuilder
        // $posts = Post::where('user_id', auth()->id())->get();//p.228 ユーザIDが(auth()->id())都同じpostデータを抽出
        // $posts = Post::where('user_id', '!=', auth()->id())->get();//p.229ログインユーザー以外の投稿
        // $posts = Post::whereDate('created_at','<=', '2025-10-20')->get();//>=:指定日以降,<=:指定日以前

        // $posts = Post::where('user_id', 0)->whereDate('created_at', '>=', '2025-10-15')->get();//P.230 複数条件
        // $posts = Post::orderBy('created_at', 'desc')->get();//データ並べ替え
        // $posts = Post::whereDate('created_at', '2025-10-15')->first();//一意のデータを取り出す。@foreachだとエラー
        // $posts = Post::find(1);//IDが1の値を取り出す。@foreachだとエラー
        return view('post.index', compact('posts'));
    }
    //
}
