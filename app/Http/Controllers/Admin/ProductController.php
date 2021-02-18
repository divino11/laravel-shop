<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
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

        return view('admin.product.create', [
            'categories' => $categories
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
            $product->status = $request->status;

            if ($request->main_image) {
                $file = $request->main_image;
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path("images"), $filename);
                $product->image = $filename;
            }
        }

        if ($product->save()) {
            if ($request->size_name) {
                $sizes = array_combine($request->size_name, $request->size_count);

                foreach ($sizes as $name => $count) {
                    DB::table('sizes_products')->insert([
                        'product_id' => $product->id, 'type' => $name, 'count' => $count
                    ]);
                }
            }
            return redirect()->route('products.index')
                ->with('success', 'Greate! Product created successfully.');
        } else {
            return redirect()->route('product.create')
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
        $sizes = DB::table('sizes_products')->where('product_id', $id)->get();
        $categories = Category::all();

        return view('admin.product.edit', [
            'product' => $product,
            'productSizes' => $sizes,
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
        $product->status = $request->status;

        if ($product->image !== $request->main_image_hidden) {
            $file = $request->main_image;
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path("images"), $filename);
            $product->image = $filename;
        }

        if ($product->save()) {
            if ($request->size_name) {
                $sizes = array_combine($request->size_name, $request->size_count);
                foreach ($sizes as $name => $count) {
                    DB::table('sizes_products')->where('product_id', $product->id)->where('type', $name)->update([
                        'type' => $name, 'count' => $count
                    ]);
                }
            }
            return redirect()->route('products.index')
                ->with('success', 'Greate! Product updated successfully.');
        } else {
            return redirect()->route('product.edit')
                ->with('error', 'Error! Check fields');
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
            ->with('success', 'Product deleted successfully');
    }
}
