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
    function index() {
        $articles = Article::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.article.index', compact('articles', 'user', 'menu'));
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
        $article = Article::find($id);
        
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images/article');
            Storage::delete('images/article/'.$article->image);
            $article->image = $path;
        }
        $article->save();
        return redirect()->route('admin.article.index');
    }

    function delete($id) {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('admin.article.index');
    }
}
