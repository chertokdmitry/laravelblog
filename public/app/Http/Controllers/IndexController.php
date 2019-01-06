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

        $this->commentCount =  self::cache('commentCount', "commentCount");
    }

    public static function commentCount()
    {
        $comments = Comment::all();
        $groupedComments = $comments->groupBy('article_id');
        $groupedComments->toArray();

        foreach ($groupedComments as $comment) {

            $comment->count();
            $articleId = $comment->first()->article_id;
            $commentCount[$articleId] = $comment->count();
        }

        return $commentCount;
    }

    public static function get_method($object, $method){
        return function() use($object, $method){
            $args = func_get_args();
            return call_user_func_array(array($object, $method), $args);
        };
    }

    public static function cache($key, $method){

        $data = Cache::remember($key, 60, function () use ($method) {
            return self::$method();
        });

        return $data;
    }

    public static function getArticles()
    {
        return Article::with('category')->paginate(6);
    }

    public static function getFeaturedArticles()
    {
        return Article::with('category')->where('featured', 1)->get();
    }

    public function index()
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $key = 'articles-page-' . $currentPage;
        $articles =  self::cache($key, "getArticles");

        $featuredArticles =  self::cache('featured', "getFeaturedArticles");

        $view = view('main', ['categories' => $this->categories,
            'articles' => $articles,
            'comment_count' => $this->commentCount,
            'featured_articles' => $featuredArticles])->render();

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

        $articles = Cache::remember($cacheKey, 60, function () use($month, $year){
            return Article::with('category')
                ->whereMonth('created_at', '=', date($month))
                ->whereYear('created_at', '=', date($year))
                ->paginate(6);
        });


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