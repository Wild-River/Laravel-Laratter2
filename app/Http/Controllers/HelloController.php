<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        $message = "これはコントローラから渡されたメッセージです。";
        $description = "このように、Controllerで処理した結果やデータベースから取得した値をViewに渡すことができます。";

        return view('hello.index', compact('message', 'description'));
    }
}
