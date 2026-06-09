@extends('layouts.public')

@section('title', 'معرض الصور | '.($S['site_name'] ?? 'Bio-Graphene'))
@section('desc', 'لقطات من المعمل وعمليات الإنتاج والمادة النانوية.')

@section('content')
<main>
  <section class="page-hero">
    <div class="wrap">
      <span class="eyebrow"><span class="dot"></span>Gallery</span>
      <h1 class="sect-title">معرض <span class="grad-text">الصور</span></h1>
      <p class="sect-lead">لقطات من المعمل وعمليات الإنتاج والمادة النانوية.</p>
    </div>
  </section>

  @forelse($folders as $folder)
  <section class="gallery-folder" style="padding-top:{{ $loop->first ? '30px' : '56px' }}">
    <div class="wrap">
      <h2 class="folder-title"><span class="grad-text">{{ $folder->title }}</span></h2>
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
  @empty
  <section style="padding-top:30px">
    <div class="wrap">
      <div class="grid gal-grid">
        @for($i = 0; $i < 6; $i++)
        <div class="gtile reveal"><span>صورة قريبًا</span><span class="wm">Bio·Graphene</span></div>
        @endfor
      </div>
    </div>
  </section>
  @endforelse

  @include('public.partials.cta')
</main>
@endsection
