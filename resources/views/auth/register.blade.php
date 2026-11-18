<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Criar conta | InsightFlow</title><link rel="stylesheet" href="{{ asset('css/insightflow.css') }}"></head>
<body class="auth-page"><div class="auth-card register-card"><a class="brand auth-brand" href="/"><span class="brand-mark">I</span><span>Insight<span class="brand-light">Flow</span></span></a><p class="eyebrow">COMECE AGORA</p><h1>Crie sua conta</h1><p class="muted">Cadastre sua empresa para começar a organizar sua operação.</p>
@if($errors->any())<div class="alert error">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
<form method="POST" action="{{ route('register') }}">@csrf
<label>Nome da empresa</label><input name="company_name" value="{{ old('company_name') }}" placeholder="Ex.: Assistência Técnica Silva" required>
<label>Seu nome</label><input name="name" value="{{ old('name') }}" placeholder="Nome completo" required>
<label>E-mail</label><input type="email" name="email" value="{{ old('email') }}" placeholder="voce@empresa.com" required>
<label>Senha</label><input type="password" name="password" placeholder="Mínimo de 8 caracteres" required>
<label>Confirme sua senha</label><input type="password" name="password_confirmation" placeholder="Digite novamente" required>
<button class="btn primary full">Criar minha conta</button></form>
<p class="auth-foot">Já possui uma conta? <a href="{{ route('login') }}">Fazer login</a></p></div><div class="auth-decoration"><div class="decor-orb"></div><div class="decor-copy"><span>SIMPLES. ORGANIZADO. INTELIGENTE.</span><h2>O próximo passo<br>do seu negócio.</h2><p>Uma visão mais clara da sua empresa começa com uma operação organizada.</p></div></div></body></html>
