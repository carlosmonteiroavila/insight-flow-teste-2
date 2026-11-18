@extends('layouts.app')
@section('title', $product->exists ? 'Editar produto' : 'Novo produto')
@section('content')
<div class="page-heading"><div><p class="eyebrow">CONTROLE DE ESTOQUE</p><h1>{{ $product->exists ? 'Editar produto' : 'Novo produto' }}</h1><p class="muted">Cadastre os materiais e produtos utilizados na sua operação.</p></div><a class="btn secondary" href="{{ route('estoque.index') }}">← Voltar</a></div>
<div class="panel form-panel"><form method="POST" action="{{ $product->exists ? route('estoque.update', $product) : route('estoque.store') }}">@csrf @if($product->exists) @method('PUT') @endif
<div class="form-grid"><div class="field full-field"><label>Nome do produto *</label><input name="name" value="{{ old('name', $product->name) }}" required></div>
<div class="field"><label>SKU / Código</label><input name="sku" value="{{ old('sku', $product->sku) }}"></div><div class="field"><label>Categoria</label><input name="category" value="{{ old('category', $product->category) }}"></div>
<div class="field"><label>Quantidade atual *</label><input type="number" name="quantity" min="0" value="{{ old('quantity', $product->quantity ?? 0) }}" {{ $product->exists ? 'readonly' : '' }} required>@if($product->exists)<small>Use “Movimentar” na listagem para alterar o saldo.</small>@endif</div>
<div class="field"><label>Estoque mínimo *</label><input type="number" name="minimum_quantity" min="0" value="{{ old('minimum_quantity', $product->minimum_quantity ?? 0) }}" required></div>
<div class="field"><label>Custo unitário (R$) *</label><input type="number" name="unit_cost" step="0.01" min="0" value="{{ old('unit_cost', $product->unit_cost ?? '0.00') }}" required></div>
<div class="field"><label>Preço de venda (R$)</label><input type="number" name="sale_price" step="0.01" min="0" value="{{ old('sale_price', $product->sale_price) }}"></div>
<div class="field full-field"><label>Fornecedor</label><input name="supplier" value="{{ old('supplier', $product->supplier) }}"></div></div>
<div class="form-actions"><a class="btn secondary" href="{{ route('estoque.index') }}">Cancelar</a><button class="btn primary">Salvar produto</button></div></form></div>
@endsection
