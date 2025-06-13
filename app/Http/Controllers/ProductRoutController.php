<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductRoutController extends Controller
{
    public function index()
    {
        return view('products.index', ['products' => Product::all()]);
    }

    public function create()
    {
        return view('products.form');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Product $product)
    {
        return view('products.form', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');
    }
}
