<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('layouts.blog', [
            'posts' => Blog::where('status', true)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function show(string $slug)
    {
        return view('layouts.blog-single', [
            'post' => Blog::where('slug', $slug)->first()
        ]);
    }
}
