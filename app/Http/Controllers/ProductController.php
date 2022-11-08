<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $products = Product::query()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->with(['category'])
            ->orderByDesc('created_at')
            ->paginate();

        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $categories = Category::query()->where('user_id', auth()->user()->getAuthIdentifier())->get();

        return Inertia::render('Products/Create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {


        $product = Product::query()
            ->create(array_merge($request->only(['name', 'description', 'price', 'category_id']),
                ['user_id' => auth()->user()->getAuthIdentifier()]));

        if ($request->file('image')) {
            $file_name = Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();

            $folder_path = storage_path('app/products/' . auth()->user()->getAuthIdentifier() . '/' . $product->id);
            mkdir($folder_path, 0777, true);

            $request->file('image')->move($folder_path, $file_name);

            $product->image()->create([
                'path' => $file_name
            ]);
        }

        return redirect(route('products.index'))->with(['success' => 'Product was created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        //TODO: also delete images

        return redirect()->route('products.index')->with('success', 'Product was deleted successfully');

    }
}
