@extends('layouts.public')

@section('title', $folder->title.' | معرض الصور | '.($S['site_name'] ?? 'Bio-Graphene'))
@section('desc', 'صور '.$folder->title.' — '.($S['site_name'] ?? 'Bio-Graphene'))

@section('content')
<main>
  <section class="page-hero">
    <div class="wrap">
      <a href="{{ route('gallery') }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
        كل المجلدات
      </a>
      <span class="eyebrow"><span class="dot"></span>Gallery</span>
      <h1 class="sect-title"><span class="grad-text">{{ $folder->title }}</span></h1>
      <p class="sect-lead">{{ $folder->images->count() }} صورة</p>
    </div>
  </section>

  <section style="padding-top:30px">
    <div class="wrap">
      <div class="grid gal-grid">
        @foreach($folder->images as $g)
          <figure class="gtile reveal">
            <img src="{{ asset('storage/'.$g->path) }}" alt="{{ $g->caption }}" loading="lazy">
            @if($g->caption)<figcaption>{{ $g->caption }}</figcaption>@endif
          </figure>
        @endforeach
      </div>
    </div>
  </section>

  @include('public.partials.cta')
</main>
@endsection
