<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Size;
use App\SizesProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(20);

        // load the view and pass the nerds
        return view('admin.product.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();

        return view('admin.product.create', [
            'categories' => $categories,
            'sizes' => $sizes
        ]);
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
            $product = new Product;
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->price_sale = $request->price_sale;
            $product->price_sale_percent = $request->price_sale_percent;
            $product->size = implode(' / ', $request->size);
            $product->height = $request->height;
            $product->status = $request->status;

            if ($request->main_image) {
                $file = $request->main_image;
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path("images"), $filename);
                $product->image = $filename;
            }

            if ($request->a4_file) {
                $file = $request->a4_file;
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path("files"), $filename);
                $product->a4_file = $filename;
            }

            if ($request->plotter_file) {
                $file = $request->plotter_file;
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path("files"), $filename);
                $product->plotter_file = $filename;
            }

            if ($request->description_file) {
                $file = $request->description_file;
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path("files"), $filename);
                $product->description_file = $filename;
            }
        }

        if ($product->save()) {
            return redirect()->route('products.index')
                ->with('success', 'Отлично, товар успешно добавлен');
        } else {
            return redirect()->route('product.create')
                ->with('error', 'Ошибка, проверьте данные');
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
        $product = Product::find($id);

        return view('admin.product.show')
            ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $sizes = Size::all();
        $categories = Category::all();

        return view('admin.product.edit', [
            'product' => $product,
            'sizes' => $sizes,
            'categories' => $categories
        ]);
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
        $product = Product::find($request->id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->price_sale = $request->price_sale;
        $product->price_sale_percent = $request->price_sale_percent;
        $product->size = implode(' / ', $request->size);
        $product->height = $request->height;
        $product->status = $request->status;

        if ($product->image !== $request->main_image_hidden) {
            $file = $request->main_image;
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path("images"), $filename);
            $product->image = $filename;
        }

        if ($product->a4_file !== $request->a4_file_hidden) {
            $file = $request->a4_file;
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path("files"), $filename);
            $product->a4_file = $filename;
        }

        if ($product->plotter_file !== $request->plotter_file_hidden) {
            $file = $request->plotter_file;
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path("files"), $filename);
            $product->plotter_file = $filename;
        }

        if ($product->description_file !== $request->description_file_hidden) {
            $file = $request->description_file;
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path("files"), $filename);
            $product->description_file = $filename;
        }

        if ($product->save()) {
            return redirect()->route('products.index')
                ->with('success', 'Отлично, товар успешно изменен!');
        } else {
            return redirect()->route('product.edit')
                ->with('error', 'Ошибка, проверьте данные!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Товар успешно удален');
    }
}
