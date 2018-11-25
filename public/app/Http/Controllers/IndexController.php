<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;


class IndexController extends Controller
{
    public $categories;
    public $commentCount;

    public function __construct()
    {
        $this->categories = Category::all();

        $this->commentCount = Cache::remember('commentCount', 60, function () {
            $comments = Comment::all();
            $groupedComments = $comments->groupBy('article_id');
            $groupedComments->toArray();

            foreach ($groupedComments as $comment) {

                $comment->count();
                $articleId = $comment->first()->article_id;
                $commentCount[$articleId] = $comment->count();
            }

            return $commentCount;
        });
    }

    public function index()
    {
        $articles = Cache::remember('articles', 60, function () {
            return Article::with('category')->paginate(6);
        });

        $view = view('main', ['categories' => $this->categories,
            'articles' => $articles,
            'comment_count' => $this->commentCount])->render();

        return (new Response($view));
    }

    public function category($id)
    {
        $cacheKey = 'category' . $id;
        $articles = Cache::remember($cacheKey, 60, function () use($id){
            return Article::with('category')->where('category_id', $id)->paginate(6);
        });

        $view = view('main', ['categories' => $this->categories,
            'articles' => $articles,
            'comment_count' => $this->commentCount])->render();

        return (new Response($view));
    }

    public function created($month, $year)
    {
        $cacheKey = 'date' . $year . $month;
        Cache::flush();



            $articles = Article::with('category')
                ->whereMonth('created_at', '=', date($month))
                ->whereYear('created_at', '=', date($year))
                ->paginate(6);

//            dump($articles);

        $view = view('main', ['categories' => $this->categories,
            'articles' => $articles,
            'comment_count' => $this->commentCount])->render();

        return (new Response($view));
    }

    public function article($id)
    {
        $article = Article::find($id);
        $comments = Comment::where('article_id', $id)->get();

        $view = view('article', ['categories' => $this->categories, 'article' => $article, 'comments' => $comments])->render();

        return (new Response($view));
    }
}