@extends('layouts.public')

@section('title', 'معرض الصور | '.($S['site_name'] ?? 'Bio-Graphene'))
@section('desc', 'لقطات من المعمل وعمليات الإنتاج والمادة النانوية.')

@section('content')
<main>
  <section class="page-hero">
    <div class="wrap">
      <div class="page-head">
        <div class="page-head-main">
          <span class="eyebrow"><span class="dot"></span>Gallery</span>
          <h1 class="sect-title">معرض <span class="grad-text">الصور</span></h1>
        </div>
        <a href="{{ url('/') }}" class="back-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M11 18l6-6-6-6"/></svg>
          الرئيسية
        </a>
      </div>
      <p class="sect-lead">لقطات من المعمل وعمليات الإنتاج والمادة النانوية.</p>
    </div>
  </section>

  <section style="padding-top:30px">
    <div class="wrap">
      <div class="grid gal-grid">
        @forelse($gallery as $g)
          <div class="gtile reveal"><img src="{{ asset('storage/'.$g->path) }}" alt="{{ $g->caption }}"></div>
        @empty
          @for($i = 0; $i < 6; $i++)
          <div class="gtile reveal"><span>صورة قريبًا</span><span class="wm">Bio·Graphene</span></div>
          @endfor
        @endforelse
      </div>
    </div>
  </section>

  @include('public.partials.cta')
</main>
@endsection
