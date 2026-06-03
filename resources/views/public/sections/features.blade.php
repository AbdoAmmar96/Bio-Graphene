@extends('layouts.public')

@section('title', 'المميزات | '.($S['site_name'] ?? 'Bio-Graphene'))
@section('desc', 'مزيج من العبقرية الكيميائية والجدوى الاقتصادية لا تملكه أي مادة منافسة.')

@php
$featSvg = [
  'target'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/></svg>',
  'refresh' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 11-3-6.7M21 4v5h-5"/></svg>',
  'shield'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5-3 8-7 8-12V5l-8-3-8 3v5c0 5 3 9 8 12z"/></svg>',
  'leaf'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3a8 8 0 108 8M3 12h4M12 3v4"/><path d="M21 3l-6 6"/></svg>',
  'magnet'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3v8a6 6 0 0012 0V3M6 3h4M14 3h4M9 21h6"/></svg>',
  'scan'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>',
  'star'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 7.4H22l-6 4.3 2.3 7.3-6.3-4.6L5.7 21l2.3-7.3-6-4.3h7.6z"/></svg>',
  'atom'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="2"/><path d="M12 2a10 10 0 000 20M2 12a10 10 0 0020 0"/><ellipse cx="12" cy="12" rx="10" ry="4"/></svg>',
];
@endphp

@section('content')
<main>
  <section class="page-hero">
    <div class="wrap">
      <div class="page-head">
        <div class="page-head-main">
          <span class="eyebrow"><span class="dot"></span>The Masterpiece</span>
          <h1 class="sect-title">المميزات</h1>
        </div>
        <a href="{{ url('/') }}" class="back-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M11 18l6-6-6-6"/></svg>
          الرئيسية
        </a>
      </div>
      <p class="sect-lead">ما الذي يجعل المادة المبتكرة "الأفضل على الإطلاق"؟ مزيج من العبقرية الكيميائية والجدوى الاقتصادية لا تملكه أي مادة منافسة.</p>
    </div>
  </section>

  <section style="padding-top:30px">
    <div class="wrap">
      <div class="grid feat-grid">
        @foreach($features as $f)
        <div class="feat card reveal"><div class="ic">{!! $featSvg[$f->icon] ?? $featSvg['star'] !!}</div><h3>{{ $f->title }}</h3><p>{{ $f->body }}</p></div>
        @endforeach
      </div>
    </div>
  </section>

  @if(!empty($intro))
  <section>
    <div class="wrap">
      <div class="reveal">
        <span class="eyebrow"><span class="dot"></span>التقييم الاستراتيجي</span>
        <h2 class="sect-title">أبعاد <span class="grad-text">الابتكار</span></h2>
      </div>
      <div class="detail-body reveal" style="margin-top:30px">{!! $intro !!}</div>
    </div>
  </section>
  @endif

  @include('public.partials.cta')
</main>
@endsection
