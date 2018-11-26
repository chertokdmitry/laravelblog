<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        $items = Comment::paginate(20);

        $view = view('admin/comments', ['items' => $items])->render();
        return (new Response($view));
    }
}
