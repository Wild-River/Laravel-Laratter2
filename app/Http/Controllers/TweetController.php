<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ⭐️追加↓ 全ツイート(Tweet)を、それぞれの投稿者情報も含めて(with('user'))、新しい順で取得(latest()->get())
        $tweets = Tweet::with('user')->latest()->get();

        // ⭐️追加↓
        // $tweetsを'tweets.index'に渡す
        // このtweets.indexとは、resources/views配下のtweetsの中のindex.blade.phpを指すよ。
        return view('tweets.index', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ⭐️追加
        return view('tweets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション実行
        $validate = $request->validate([
            'tweet' => 'required|max:255', // tweet必須 + 最大255文字までの制限
        ]);

        // ログインユーザーのツイートとして作成
        $request->user()->tweets()->create($validate);
        // リクエストからユーザーの情報を取得し、そのユーザーのツイートとしてデータを作成

        // 一覧画面にリダイレクト
        return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        $tweet->load('comments');
        return view('tweets.show', compact('tweet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
    {
        return view('tweets.edit', compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet)
    {
        // バリデーション実行
        $request->validate([
            'tweet' => 'required|max:255',
        ]);

        // ツイート内容を更新
        $tweet->update($request->only('tweet'));

        // 詳細画面にリダイレクト
        return redirect()->route('tweets.show', $tweet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        // ツイートを削除
        $tweet->delete();

        // 一覧画面にリダイレクト
        return redirect()->route('tweets.index');
    }
}
