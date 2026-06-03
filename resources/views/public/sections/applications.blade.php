@extends('layouts.public')

@section('title', 'التطبيقات | '.($S['site_name'] ?? 'Bio-Graphene'))
@section('desc', 'التطبيقات الصناعية لمادة الابتكار: المعادن الثمينة، العناصر النادرة، الليثيوم، الألومينا، وتنقية المياه.')

@php
$arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>';
$appSvg = [
  'crystal' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2l4 6-4 14-4-14 4-6zM8 8h8"/></svg>',
  'water'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2.5S5 10 5 15a7 7 0 0014 0c0-5-7-12.5-7-12.5z"/></svg>',
  'grid'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>',
];
@endphp

@section('content')
<main>
  <section class="page-hero">
    <div class="wrap">
      <div class="page-head">
        <div class="page-head-main">
          <span class="eyebrow"><span class="dot"></span>Industrial Versatility</span>
          <h1 class="sect-title">التطبيقات</h1>
        </div>
        <a href="{{ url('/') }}" class="back-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M11 18l6-6-6-6"/></svg>
          الرئيسية
        </a>
      </div>
      <p class="sect-lead">مرونة صناعية تتكيّف مع كل عنصر عبر التحكّم في شحنة السطح والأقفال الجزيئية — من المعادن الثمينة، إلى العناصر النادرة، إلى ترقية الخامات التقليدية وتصفية الشوائب.</p>
    </div>
  </section>

  <section style="padding-top:30px">
    <div class="wrap">
      <div class="grid apps-grid">
        @foreach($apps as $a)
        <div class="card app reveal">
          <div class="tile">@switch($a->icon)
            @case('symbolsm')<small>{{ $a->symbol }}</small>@break
            @case('crystal'){!! $appSvg['crystal'] !!}@break
            @case('water'){!! $appSvg['water'] !!}@break
            @case('grid'){!! $appSvg['grid'] !!}@break
            @default{{ $a->symbol }}
          @endswitch</div>
          <div><h3>{{ $a->name }}</h3><p>{{ $a->short }}</p></div>
          <a href="{{ route('app.show', $a->slug) }}" class="more">اقرأ المقال {!! $arrow !!}</a>
        </div>
        @endforeach

        @if($overview)
        <a href="{{ route('app.show', $overview->slug) }}" class="card app-wide reveal" style="text-decoration:none">
          <div class="l">
            <div class="tile">{!! $appSvg['grid'] !!}</div>
            <div><h3>{{ $overview->name }}</h3><p style="margin:0">{{ $overview->short }}</p></div>
          </div>
          <span class="more" style="margin:0">عرض المقال {!! $arrow !!}</span>
        </a>
        @endif
      </div>
    </div>
  </section>

  @include('public.partials.cta')
</main>
@endsection
