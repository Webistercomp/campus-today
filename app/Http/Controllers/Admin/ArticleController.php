<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    function index(Request $request) {
        $articles = Article::all();
        $title = $request->title;
        if($title) {
            $articles = Article::where('title', 'LIKE', '%' . $title . '%')->get();
        }
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];

        return view('admin.article.index', compact('articles', 'user', 'menu', 'title'));
    }

    function create() {
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.article.create', compact('user', 'menu'));
    }

    function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $newArticle = new Article();
        $newArticle->title = $request->title;
        $newArticle->body = $request->body;
        $newArticle->description = $request->description;
        if($request->hasFile('image')) {
            $time = time();
            $ext = $request->image->extension();
            $request->file('image')->storeAs('public/article/images/', $time.'.'.$ext);
            $newArticle->image = $time.'.'.$ext;
        }
        if($request->has('active')) {
            $newArticle->active = 1;
        } else {
            $newArticle->active = 0;
        }
        $newArticle->save();
        return redirect()->route('admin.article.index');
    }
    
    function show($id) {
        $article = Article::find($id);
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.article.show', compact('article', 'user', 'menu'));
    }
    
    function edit($id) {
        $article = Article::find($id);
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.article.edit', compact('article', 'user', 'menu'));
    }

    function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $article = Article::find($id);
        $article->title = $request->title;
        $article->body = $request->body;
        $article->description = $request->description;
        if($request->hasFile('image')) {
            $time = time();
            $ext = $request->image->extension();
            $request->file('image')->storeAs('public/article/images/', $time.'.'.$ext);
            Storage::delete('public/article/images/'.$article->image);
            $article->image = $time.'.'.$ext;
        }
        if($request->has('active')) {
            $article->active = 1;
        } else {
            $article->active = 0;
        }
        $article->save();
        return redirect()->route('admin.article.show', $id);
    }

    function destroy($id) {
        $article = Article::find($id);
        Storage::delete('public/article/images/'.$article->image);
        $article->delete();
        return redirect()->route('admin.article.index');
    }
}
