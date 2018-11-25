<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ArticleResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Article::all();

        $view = view('admin/articles', ['items' => $items])->render();
        return (new Response($view));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Category::all();

        $view = view('admin/createarticle', ['categories' => $items])->render();
        return (new Response($view));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photoName = time().'.'.$request->userfile->getClientOriginalExtension();
        $request->userfile->move(public_path('photos'), $photoName);

        $item = new Article;
        $item->title = $request->title;
        $item->content = $request->fulltext;
        $item->url = $photoName;
        $item->category_id = $request->category;
        $item->save();

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Article::find($id);

        $view = view('admin/article', ['item' => $item])->render();
        return (new Response($view));
    }

    public function about($id)
    {

        echo $id;
//        $item = Article::find($id);
//        $view = view('admin/article', ['item'=>$item])->render();
//
//        return (new Response($view));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
