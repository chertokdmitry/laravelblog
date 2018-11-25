<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $view = view('config', ['album_order' => $user->album_order,
            'photo_order' => $user->photo_order])->render();
        return (new Response($view));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if($request->albums) $user->album_order = $request->albums;
        if($request->photos) $user->photo_order = $request->photos;
        $user->save();

        $view = view('home', ['message' => "Данные записаны"])->render();
        return (new Response($view));
    }
}
