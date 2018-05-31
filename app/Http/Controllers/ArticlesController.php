<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticlesRequest;

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
    
    public function create()
    {
        return view('articles.create');
    }
    
    public function store(ArticlesRequest $request)
    {
        $article    = \App\User::find(1)->articles()
                                        ->create($request->all());
        
        if (!$article) {
            return back()->with('flash_message', '글이 저장되지 않았습니다.')
                        ->withInput();
        }
        
        event(new \App\Events\ArticlesEvent($article));
        
        return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
    }
}
