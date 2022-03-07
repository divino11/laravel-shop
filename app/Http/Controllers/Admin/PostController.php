<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Product;
use App\SizesProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::paginate(20);

        // load the view and pass the nerds
        return view('admin.blog.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (count($request->all()) > 1) {
            $post = new Post;
            $post->title = $request->title;
            $post->content = $request->get('content');
            $post->status = $request->status;

            if ($request->image) {
                $file = $request->image;
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path("images"), $filename);
                $post->image = $filename;
            }
        }

        if ($post->save()) {
            return redirect()->route('post.index')
                ->with('success', 'Запись успешно создана!');
        } else {
            return redirect()->route('post.create')
                ->with('error', 'Ошибка, проверьте поля!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('admin.blog.show')
            ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.blog.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->get('content');
        $post->status = $request->status;

        if ($post->image !== $request->main_image_hidden) {
            $file = $request->image;
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path("images"), $filename);
            $post->image = $filename;
        }

        if ($post->save()) {
            return redirect()->route('post.index')
                ->with('success', 'Запись отредактирована!');
        } else {
            return redirect()->route('post.edit')
                ->with('error', 'Ошибка, проверьте поля');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('post.index')
            ->with('success', 'Запись была удалена');
    }
}
