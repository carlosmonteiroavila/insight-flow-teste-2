<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Entrar | InsightFlow</title><link rel="stylesheet" href="{{ asset('css/insightflow.css') }}"></head>
<body class="auth-page"><div class="auth-card"><a class="brand auth-brand" href="/"><span class="brand-mark">I</span><span>Insight<span class="brand-light">Flow</span></span></a><p class="eyebrow">BEM-VINDO DE VOLTA</p><h1>Acesse sua conta</h1><p class="muted">Entre para acompanhar a operação da sua empresa.</p>
@if($errors->any())<div class="alert error">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('login') }}">@csrf
<label>E-mail</label><input type="email" name="email" value="{{ old('email') }}" placeholder="voce@empresa.com" required autofocus>
<label>Senha</label><input type="password" name="password" placeholder="Sua senha" required>
<label class="check"><input type="checkbox" name="remember"> Manter conectado</label>
<button class="btn primary full">Entrar na plataforma</button></form>
<p class="auth-foot">Ainda não tem uma conta? <a href="{{ route('register') }}">Criar conta grátis</a></p></div><div class="auth-decoration"><div class="decor-orb"></div><div class="decor-copy"><span>GESTÃO MAIS INTELIGENTE</span><h2>Suas operações.<br>Em um só lugar.</h2><p>Organize clientes, acompanhe seu estoque e tenha mais clareza para decidir.</p></div></div></body></html>
