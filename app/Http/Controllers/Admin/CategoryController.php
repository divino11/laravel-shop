<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(20);

        // load the view and pass the nerds
        return view('admin.category.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->code = $request->code;
        $category->description = $request->description;

        if ($request->main_image) {
            $file = $request->main_image;
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path("images"), $filename);
            $category->image = $filename;
        }


        if ($category->save()) {
            return redirect()->route('category.index')
                ->with('success', 'Greate! Category created successfully.');
        } else {
            return redirect()->route('category.create')
                ->with('error', 'Error! Check fields');
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
        $category = Category::find($id);

        return view('admin.category.show')
            ->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.edit')
            ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->code = $request->code;
        $category->description = $request->description;

        if ($request->main_image) {
            $file = $request->main_image;
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path("images"), $filename);
            $category->image = $filename;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully');
    }
}
