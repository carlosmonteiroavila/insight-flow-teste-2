@extends('layouts.app')
@section('title', 'Visão geral')
@section('content')
<div class="page-heading"><div><p class="eyebrow">PAINEL DE CONTROLE</p><h1>Visão geral</h1><p class="muted">Aqui está um resumo da sua operação.</p></div><span class="date-pill">{{ now()->translatedFormat('d \d\e F, Y') }}</span></div>
<div class="welcome-strip"><div><span class="welcome-label">BEM-VINDO À INSIGHTFLOW</span><h2>Olá, {{ explode(' ', auth()->user()->name)[0] }}. 👋</h2><p>Vamos acompanhar o que está acontecendo na sua empresa?</p></div><div class="welcome-symbol">↗</div></div>
<div class="stats-grid">
<div class="stat-card"><div class="stat-top"><span>Clientes cadastrados</span><span class="stat-icon blue">♙</span></div><strong>{{ $stats['clients'] }}</strong><small>Total na sua carteira</small></div>
<div class="stat-card"><div class="stat-top"><span>Produtos no estoque</span><span class="stat-icon purple">▣</span></div><strong>{{ $stats['products'] }}</strong><small>Itens cadastrados</small></div>
<div class="stat-card"><div class="stat-top"><span>Estoque baixo</span><span class="stat-icon orange">!</span></div><strong>{{ $stats['low_stock'] }}</strong><small>Produtos no mínimo ou abaixo</small></div>
<div class="stat-card"><div class="stat-top"><span>Valor em estoque</span><span class="stat-icon green">R$</span></div><strong>R$ {{ number_format((float)$stats['stock_value'], 2, ',', '.') }}</strong><small>Estimativa pelo custo unitário</small></div>
</div>
<div class="content-grid"><section class="panel"><div class="panel-heading"><div><h3>Movimentações recentes</h3><p>Últimas entradas e saídas do estoque</p></div><a href="{{ route('estoque.index') }}">Ver estoque →</a></div>
@if($recentMovements->isEmpty())<div class="empty-state"><div class="empty-icon">↔</div><strong>Nenhuma movimentação ainda</strong><p>Quando você registrar entradas ou saídas, elas aparecerão aqui.</p></div>@else
<div class="table-wrap"><table><thead><tr><th>Produto</th><th>Tipo</th><th>Quantidade</th><th>Data</th></tr></thead><tbody>@foreach($recentMovements as $movement)<tr><td><strong>{{ $movement->product->name }}</strong></td><td><span class="tag {{ $movement->type === 'entrada' ? 'tag-green' : 'tag-orange' }}">{{ ucfirst($movement->type) }}</span></td><td>{{ $movement->quantity }}</td><td>{{ $movement->created_at->format('d/m/Y H:i') }}</td></tr>@endforeach</tbody></table></div>@endif
</section><section class="panel"><div class="panel-heading"><div><h3>Atenção ao estoque</h3><p>Itens que precisam de reposição</p></div></div>
@if($lowStockProducts->isEmpty())<div class="empty-state compact"><div class="empty-icon">✓</div><strong>Tudo certo por aqui</strong><p>Nenhum produto está no nível mínimo.</p></div>@else
@foreach($lowStockProducts as $product)<div class="low-item"><div><strong>{{ $product->name }}</strong><small>Estoque mínimo: {{ $product->minimum_quantity }}</small></div><span class="stock-number">{{ $product->quantity }} un.</span></div>@endforeach
@endif</section></div>
<div class="quick-actions"><a href="{{ route('clientes.create') }}" class="quick-card"><span class="quick-icon">＋</span><span><strong>Novo cliente</strong><small>Adicionar à sua carteira</small></span><b>→</b></a><a href="{{ route('estoque.create') }}" class="quick-card"><span class="quick-icon">▣</span><span><strong>Novo produto</strong><small>Cadastrar item no estoque</small></span><b>→</b></a></div>
@endsection
