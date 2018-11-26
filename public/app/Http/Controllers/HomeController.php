<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::count();
        $comments = Comment::count();
        $categories = Category::count();

        $view = view('admin/index', [
            'articles' => $articles,
            'comments' => $comments,
            'categories' => $categories
        ])->render();

        return (new Response($view));
    }
}
