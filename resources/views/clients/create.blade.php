@extends('layouts.app')
@section('title', $client->exists ? 'Editar cliente' : 'Novo cliente')
@section('content')
<div class="page-heading"><div><p class="eyebrow">CADASTRO</p><h1>{{ $client->exists ? 'Editar cliente' : 'Novo cliente' }}</h1><p class="muted">Preencha os dados para manter sua carteira organizada.</p></div><a class="btn secondary" href="{{ route('clientes.index') }}">← Voltar</a></div>
<div class="panel form-panel"><form method="POST" action="{{ $client->exists ? route('clientes.update', $client) : route('clientes.store') }}">@csrf @if($client->exists) @method('PUT') @endif
<div class="form-grid"><div class="field full-field"><label>Nome completo / Razão social *</label><input name="name" value="{{ old('name', $client->name) }}" required maxlength="150"></div>
<div class="field"><label>CPF / CNPJ</label><input name="document" value="{{ old('document', $client->document) }}"></div><div class="field"><label>Telefone</label><input name="phone" value="{{ old('phone', $client->phone) }}"></div>
<div class="field full-field"><label>E-mail</label><input type="email" name="email" value="{{ old('email', $client->email) }}"></div><div class="field full-field"><label>Endereço</label><input name="address" value="{{ old('address', $client->address) }}"></div></div>
<div class="form-actions"><a class="btn secondary" href="{{ route('clientes.index') }}">Cancelar</a><button class="btn primary">Salvar cliente</button></div></form></div>
@endsection
