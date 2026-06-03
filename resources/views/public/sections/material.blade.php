@extends('layouts.public')

@section('title', 'المادة المبتكرة | '.($S['site_name'] ?? 'Bio-Graphene'))
@section('desc', 'أكسيد الجرافين الحيوي بلا حدود — limitless Bio-Go: المادة النانوية المبتكرة ونسخها وتطويراتها.')

@php
$arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>';
@endphp

@section('content')
<main>
  <section class="page-hero">
    <div class="wrap">
      <div class="page-head">
        <div class="page-head-main">
          <span class="eyebrow"><span class="dot"></span>limitless Bio-Go</span>
          <h1 class="sect-title">المادة <span class="grad-text">المبتكرة</span></h1>
        </div>
        <a href="{{ url('/') }}" class="back-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M11 18l6-6-6-6"/></svg>
          الرئيسية
        </a>
      </div>
      <p class="sect-lead">أكسيد الجرافين الحيوي بلا حدود: مركّب نانوي كربوني هجين ثلاثي الأبعاد (3D Hierarchical Hybrid Graphene Oxide) يدمج مخلفات نباتية مختارة — كل مكوّن يؤدي وظيفة دقيقة تكمّل عيوب غيره.</p>
    </div>
  </section>

  @if(!empty($intro))
  <section style="padding-top:40px">
    <div class="wrap">
      <div class="detail-body reveal">{!! $intro !!}</div>
    </div>
  </section>
  @endif

  <section>
    <div class="wrap">
      <div class="reveal">
        <span class="eyebrow"><span class="dot"></span>الإصدارات</span>
        <h2 class="sect-title">نسخ المادة</h2>
      </div>
      <div class="grid mat-grid" style="margin-top:40px">
        @foreach($materials as $m)
        <div class="card reveal">
          <h3>{{ $m->title }}</h3>
          <p>{{ $m->short }}</p>
          <a href="{{ route('material.show', $m->slug) }}" class="more">اقرأ التفاصيل {!! $arrow !!}</a>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  @if(!empty($extras))
  <section>
    <div class="wrap">
      <div class="reveal">
        <span class="eyebrow"><span class="dot"></span>التطوير المستمر</span>
        <h2 class="sect-title">الإضافات <span class="grad-text">والتطويرات</span></h2>
      </div>
      <div class="detail-body reveal" style="margin-top:30px">{!! $extras !!}</div>
    </div>
  </section>
  @endif

  @include('public.partials.cta')
</main>
@endsection
