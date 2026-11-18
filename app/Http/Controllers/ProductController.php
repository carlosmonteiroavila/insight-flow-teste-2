<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('company_id', auth()->user()->company_id)
            ->latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create', ['product' => new Product()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['company_id'] = auth()->user()->company_id;
        Product::create($data);

        return redirect()->route('estoque.index')->with('success', 'Produto cadastrado.');
    }

    public function edit(Product $product)
    {
        $this->authorizeCompany($product);
        return view('products.create', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeCompany($product);
        $data = $this->validated($request);
        unset($data['quantity']); // quantidade só muda por movimentação de estoque
        $product->update($data);

        return redirect()->route('estoque.index')->with('success', 'Produto atualizado.');
    }

    public function destroy(Product $product)
    {
        $this->authorizeCompany($product);
        $product->delete();

        return redirect()->route('estoque.index')->with('success', 'Produto removido.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'sku' => ['nullable', 'string', 'max:80'],
            'category' => ['nullable', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:0', 'max:1000000'],
            'minimum_quantity' => ['required', 'integer', 'min:0', 'max:1000000'],
            'unit_cost' => ['required', 'numeric', 'min:0', 'max:99999999'],
            'sale_price' => ['nullable', 'numeric', 'min:0', 'max:99999999'],
            'supplier' => ['nullable', 'string', 'max:150'],
        ]);
    }

    private function authorizeCompany(Product $product): void
    {
        abort_unless($product->company_id === auth()->user()->company_id, 404);
    }
}
