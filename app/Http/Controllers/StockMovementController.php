<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockMovementController extends Controller
{
    public function store(Request $request, Product $product)
    {
        abort_unless($product->company_id === auth()->user()->company_id, 404);

        $data = $request->validate([
            'type' => ['required', 'in:entrada,saida'],
            'quantity' => ['required', 'integer', 'min:1', 'max:1000000'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($product, $data) {
            $locked = Product::whereKey($product->id)->lockForUpdate()->firstOrFail();

            if ($data['type'] === 'saida' && $locked->quantity < $data['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'Estoque insuficiente para essa saída.',
                ]);
            }

            $locked->quantity += $data['type'] === 'entrada'
                ? $data['quantity']
                : -$data['quantity'];
            $locked->save();

            StockMovement::create([
                'company_id' => auth()->user()->company_id,
                'product_id' => $locked->id,
                'user_id' => auth()->id(),
                'type' => $data['type'],
                'quantity' => $data['quantity'],
                'notes' => $data['notes'] ?? null,
            ]);
        });

        return redirect()->route('estoque.index')->with('success', 'Movimentação registrada.');
    }
}
