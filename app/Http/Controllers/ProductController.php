<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('homepage', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $inputData = $request->only([
            'name',
            'code',
            'price',
            'quantity',
            'description',
        ]);

        try {
            $product = Product::create(array_merge($inputData, [
                'user_id' => auth()->id()
            ]));

            return redirect('/products/' . $product->id);
        } catch (\Throwable $th) {
            return back()->with('status', 'Create failed!');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'product' => Product::findOrFail($id),
            'user' => auth()->user(),
        ];

        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }

        $data = [
            'user' => auth()->user(),
            'product' => $product,
        ];

        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        $inputData = $request->all();
        $product = Product::find($id);

        try {
            $product->update([
                'name' => $inputData['name'],
                'price' => $inputData['price'],
                'quantity' => $inputData['quantity'],
                'description' => $inputData['description'],
            ]);

            return redirect('/products/' . $product->id);
        } catch (\Throwable $th) {
            return back()->with('status', 'Update failed!');;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        try {
            $product->delete();

            return redirect('/products')->with('status', 'Delete Success!');
        } catch (\Throwable $th) {
            return back()->with('status', 'Delete Failure!');
        }
    }
}
