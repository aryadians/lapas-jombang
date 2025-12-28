<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index()
    {
        $allNews = News::where('status', 'published')->latest()->paginate(10);
        return view('news.index', compact('allNews'));
    }

    /**
     * Display the specified news.
     */
    public function show(News $news)
    {
        // Ensure only published news can be viewed publicly
        if ($news->status !== 'published') {
            abort(404);
        }
        return view('news.show', compact('news'));
    }
}
