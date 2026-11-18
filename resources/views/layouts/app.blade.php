<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel') | InsightFlow</title>
    <link rel="stylesheet" href="{{ asset('css/insightflow.css') }}">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="{{ route('dashboard') }}"><span class="brand-mark">I</span><span>Insight<span class="brand-light">Flow</span></span></a>
        <div class="side-label">MENU PRINCIPAL</div>
        <nav>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><span>▦</span> Visão geral</a>
            <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}"><span>♙</span> Clientes</a>
            <a href="{{ route('estoque.index') }}" class="{{ request()->routeIs('estoque.*') ? 'active' : '' }}"><span>▣</span> Estoque</a>
        </nav>
        <div class="sidebar-bottom">
            <div class="company-chip"><div class="avatar">{{ strtoupper(substr(auth()->user()->company->name ?? 'I', 0, 1)) }}</div><div><strong>{{ auth()->user()->company->name ?? 'Minha empresa' }}</strong><small>Plano inicial</small></div></div>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="logout">↪ Sair da conta</button></form>
        </div>
    </aside>
    <main class="main-content">
        <header class="topbar"><div class="mobile-brand">InsightFlow</div><div class="topbar-right"><span class="status-dot"></span><span>Sistema operacional</span><div class="avatar small">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div></div></header>
        <section class="page-content">
            @if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="alert error">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
            @yield('content')
        </section>
        <footer class="footer">© {{ date('Y') }} InsightFlow · Gestão inteligente para sua empresa</footer>
    </main>
</div>
</body>
</html>
