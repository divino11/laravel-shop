<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Blog::paginate(20);

        // load the view and pass the nerds
        return view('admin.blog.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $post = new Blog;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->input('content');
        $post->status = $request->status;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->storeAs('/public/posts/', $filename);
            $post->image = $filename;
        }

        if ($post->save()) {
            return redirect()->route('blog.index')
                ->with('success', 'Запись успешно создана!');
        }

        return redirect()->route('blog.create')
            ->with('error', 'Ошибка, проверьте поля!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $post = Blog::find($id);

        return view('admin.blog.show')
            ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $post = Blog::find($id);

        return view('admin.blog.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $post = Blog::find($id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->get('content');
        $post->status = $request->status;

        if ($post->image !== $request->main_image_hidden) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->storeAs('/public/posts/', $filename);
            $post->image = $filename;
        }

        if ($post->save()) {
            return redirect()->route('blog.index')
                ->with('success', 'Запись отредактирована!');
        }

        return redirect()->route('blog.edit')
            ->with('error', 'Ошибка, проверьте поля');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.index')
            ->with('success', 'Запись успешно удалена');
    }

    public function uploadImage(Request $request)
    {
        // Validate and store the uploaded image
        $image = $request->file('upload');
        $imageName = $image->getClientOriginalName();
        $image->storeAs('images', $imageName, 'public'); // Adjust storage path as needed

        // Return the image URL
        $url = asset('storage/images/' . $imageName);
        return response()->json(['uploaded' => true, 'url' => $url]);
    }
}
