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
