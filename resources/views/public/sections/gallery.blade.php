@extends('layouts.public')

@section('title', 'معرض الصور | '.($S['site_name'] ?? 'Bio-Graphene'))
@section('desc', 'لقطات من المعمل وعمليات الإنتاج والمادة النانوية.')

@section('content')
<main>
  <section class="page-hero">
    <div class="wrap">
      <span class="eyebrow"><span class="dot"></span>Gallery</span>
      <h1 class="sect-title">معرض <span class="grad-text">الصور</span></h1>
      <p class="sect-lead">اختر أحد المجلدات لعرض صوره كاملةً.</p>
    </div>
  </section>

  <section style="padding-top:30px">
    <div class="wrap">
      @if($folders->isNotEmpty())
      <div class="grid folder-cards">
        @foreach($folders as $folder)
        @php($cover = $folder->images->first())
        <a href="{{ route('gallery.folder', $folder->slug) }}" class="folder-card reveal">
          <div class="fc-cover">
            <img src="{{ asset('storage/'.$cover->path) }}" alt="{{ $folder->title }}" loading="lazy">
            <span class="fc-count">{{ $folder->images->count() }} صورة</span>
          </div>
          <div class="fc-body">
            <h3>{{ $folder->title }}</h3>
            <span class="fc-link">عرض الصور
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
            </span>
          </div>
        </a>
        @endforeach
      </div>
      @else
      <div class="grid gal-grid">
        @for($i = 0; $i < 6; $i++)
        <div class="gtile reveal"><span>صورة قريبًا</span><span class="wm">Bio·Graphene</span></div>
        @endfor
      </div>
      @endif
    </div>
  </section>

  @include('public.partials.cta')
</main>
@endsection
