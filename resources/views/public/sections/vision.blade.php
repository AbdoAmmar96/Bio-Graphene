@extends('layouts.public')

@section('title', 'رؤية المستقبل | '.($S['site_name'] ?? 'Bio-Graphene'))
@section('desc', 'الابتكار كرافعة تكنولوجية استراتيجية لنقل الاقتصاد المصري نحو التكنولوجيا الفائقة والمعرفة.')

@section('content')
<main>
  <section class="page-hero">
    <div class="wrap">
      <div class="page-head">
        <div class="page-head-main">
          <span class="eyebrow"><span class="dot"></span>Critical Technology</span>
          <h1 class="sect-title">رؤية <span class="grad-text">المستقبل</span></h1>
        </div>
        <a href="{{ url('/') }}" class="back-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M11 18l6-6-6-6"/></svg>
          الرئيسية
        </a>
      </div>
      <p class="sect-lead">الابتكار ليس مجرد نجاح علمي، بل رافعة تكنولوجية استراتيجية قادرة على نقل الاقتصاد المصري من تصنيع الخام منخفض القيمة، إلى اقتصاد قائم على التكنولوجيا الفائقة والمعرفة.</p>
    </div>
  </section>

  <section style="padding-top:30px">
    <div class="wrap">
      <div class="grid axis-grid">
        @foreach($axes as $ax)
        <div class="card axis reveal"><div class="num">{{ $ax->number }}</div><h3>{{ $ax->title }}</h3><p>{{ $ax->body }}</p></div>
        @endforeach
      </div>
      <div class="stat-band reveal">
        @foreach($stats as $st)
        <div class="stat"><div class="v lat">{{ $st->value }}</div><div class="l">{{ $st->label }}</div></div>
        @endforeach
      </div>
      <div class="grid doc-grid">
        @foreach($visionDocs as $d)
        <a href="{{ route('vision.show', $d->slug) }}" class="card doc reveal" style="text-decoration:none">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 14l4-4 3 3 5-6"/></svg></div>
          <div class="t"><h3>{{ $d->title }}</h3><span class="dl">{{ $d->subtitle }}</span></div>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:20px;color:var(--green-b)"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        @endforeach
      </div>
    </div>
  </section>

  @include('public.partials.cta')
</main>
@endsection
