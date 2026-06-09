@extends('layouts.public')

@section('title', $title.' | '.($S['site_name'] ?? 'Bio-Graphene'))
@section('desc', $subtitle ?? '')

@section('content')
<main>
  <article class="article">
    <header class="article-head">
      <div class="article-head-inner">
        <span class="eyebrow"><span class="dot"></span>{{ $eyebrow }}</span>
        <h1>{{ $title }}</h1>
        @if(!empty($subtitle))<p class="sub">{{ $subtitle }}</p>@endif
        <div class="article-meta">
          <span class="amitem grad-text" style="font-weight:700">Bio·Graphene</span>
        </div>
      </div>
    </header>

    <div class="article-body detail-body">
      {!! $body !!}
    </div>

    <div class="article-cta">
      <div>
        <h3>مهتم بهذا التطبيق أو بالتفاصيل التقنية؟</h3>
        <p>فريقنا من العلماء والباحثين جاهز للرد على استفساراتك حول الابتكار وتطبيقاته الصناعية.</p>
      </div>
      <a href="{{ url('/') }}#contact" class="btn btn-grad">تواصل معنا
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
    </div>
  </article>
</main>
@endsection
