@extends('layouts.app')
@section('title', 'Clientes')
@section('content')
<div class="page-heading"><div><p class="eyebrow">RELACIONAMENTO</p><h1>Clientes</h1><p class="muted">Gerencie os contatos e informações dos seus clientes.</p></div><a class="btn primary" href="{{ route('clientes.create') }}">＋ Novo cliente</a></div>
<div class="panel"><div class="panel-heading"><div><h3>Todos os clientes</h3><p>{{ $clients->total() }} registro(s)</p></div></div>
<div class="table-wrap"><table><thead><tr><th>Nome</th><th>Documento</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr></thead><tbody>
@forelse($clients as $client)<tr><td><strong>{{ $client->name }}</strong></td><td>{{ $client->document ?: '—' }}</td><td>{{ $client->email ?: '—' }}</td><td>{{ $client->phone ?: '—' }}</td><td class="actions"><a href="{{ route('clientes.edit', $client) }}">Editar</a><form method="POST" action="{{ route('clientes.destroy', $client) }}" onsubmit="return confirm('Remover este cliente?')">@csrf @method('DELETE')<button class="link-danger">Excluir</button></form></td></tr>
@empty<tr><td colspan="5"><div class="empty-state"><strong>Nenhum cliente cadastrado</strong><p>Adicione seu primeiro cliente para começar.</p></div></td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $clients->links() }}</div></div>
@endsection
