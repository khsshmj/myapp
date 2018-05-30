<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = \App\Article::latest()->paginate(3);
        
        return view('articles.index', compact('articles'));
    }
}
