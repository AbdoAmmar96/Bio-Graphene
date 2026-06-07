@extends('layouts.public')

@php
$arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>';
$appSvg = [
  'crystal' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2l4 6-4 14-4-14 4-6zM8 8h8"/></svg>',
  'water'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2.5S5 10 5 15a7 7 0 0014 0c0-5-7-12.5-7-12.5z"/></svg>',
  'grid'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>',
];
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
$mining = $S['mining_url'] ?? 'https://www.miningearth.com';
@endphp

@section('content')
<main>
<!-- HERO -->
<section class="hero" id="home">
  <div class="wrap hero-grid">
    <div class="hero-text">
      <span class="eyebrow"><span class="dot"></span>إحدى شركات مجموعة <a href="{{ $mining }}" target="_blank" rel="noopener" class="mining-link">Mining Earth</a></span>
      <h1 class="lat"><span class="h1-row"><img src="{{ asset('images/logo-mark.png') }}" alt="" class="title-mark">Bio-Graphene</span>
        <span class="sub">{{ $S['hero_eyebrow'] ?? 'منصة تقنية نانوية شاملة · Multifunctional Nano-Platform' }}</span>
      </h1>
      <p class="desc">{{ $S['hero_desc'] ?? '' }}</p>
      <p class="team">{{ $S['hero_team'] ?? '' }}</p>
      <p class="tagline">{{ $S['hero_tagline'] ?? '' }}</p>
      <div class="hero-cta">
        <a href="#contact" class="btn btn-grad">تواصل معنا
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
        <a href="{{ route('material') }}" class="btn btn-ghost">اكتشف الابتكار</a>
      </div>
      <div class="chips">
        <span class="chip"><b>+20</b> دورة استخلاص</span>
        <span class="chip"><b>100%</b> اقتصاد دائري</span>
        <span class="chip"><b>0</b> سيانيد</span>
      </div>
    </div>
    <div class="visual">
      <div class="glow"></div>
      <div class="ring r1"></div>
      <div class="ring r2"></div>
      <svg id="lattice" viewBox="0 0 460 460" aria-label="رسم متحرك لشبكة جرافين سداسية تلتقط أيونات المعادن"></svg>
      <div class="logo-backdrop"></div>
      <img src="{{ asset('images/logo-mark.png') }}" alt="Bio-Graphene" class="hero-logo">
      <span class="particle p1"><i></i>Au</span>
      <span class="particle p2"><i></i>Li⁺</span>
      <span class="particle p3"><i></i><bdi dir="ltr">REEs</bdi></span>
      <span class="particle p4"><i></i>Ti</span>
      <span class="particle p5"><i></i>Cu</span>
    </div>
  </div>
</section>

<!-- MISSION -->
<div class="mission"><div class="wrap"><div class="inner reveal">
  <q>{{ $S['mission_quote'] ?? '' }}</q>
</div></div></div>

<!-- MATERIAL -->
<section id="material">
  <div class="wrap">
    <div class="reveal">
      <span class="eyebrow"><span class="dot"></span>limitless Bio-Go</span>
      <h2 class="sect-title">المادة <span class="grad-text">المبتكرة</span></h2>
      <p class="sect-lead">أكسيد الجرافين الحيوي بلا حدود: مركّب نانوي كربوني هجين ثلاثي الأبعاد (3D Hierarchical Hybrid Graphene Oxide) يدمج مخلفات نباتية مختارة — كل مكوّن يؤدي وظيفة دقيقة تكمّل عيوب غيره: صلابة ميكانيكية، وشبكة طرق سريعة لتدفّق الأيونات، ومصائد ذرية من الكبريت والنيتروجين الطبيعي بدون أي إضافات صناعية سامة.</p>
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
    <div class="sect-more reveal">
      <a href="{{ route('material') }}" class="btn btn-grad"> المادة المبتكرة  {!! $arrow !!}</a>
    </div>
  </div>
</section>

<!-- APPLICATIONS -->
<section id="applications">
  <div class="wrap">
    <div class="reveal">
      <span class="eyebrow"><span class="dot"></span>Industrial Versatility</span>
      <h2 class="sect-title">التطبيقات</h2>
      <p class="sect-lead">مرونة صناعية تتكيّف مع كل عنصر عبر التحكّم في شحنة السطح والأقفال الجزيئية — من المعادن الثمينة، إلى العناصر النادرة، إلى ترقية الخامات التقليدية وتصفية الشوائب.</p>
    </div>
    <div class="grid apps-grid" style="margin-top:40px">
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
        <a href="{{ route('app.show', $a->slug) }}" class="more">التفاصيل {!! $arrow !!}</a>
      </div>
      @endforeach

      @if($overview)
      <a href="{{ route('app.show', $overview->slug) }}" class="card app-wide reveal" style="text-decoration:none">
        <div class="l">
          <div class="tile">{!! $appSvg['grid'] !!}</div>
          <div><h3>{{ $overview->name }}</h3><p style="margin:0">{{ $overview->short }}</p></div>
        </div>
        <span class="more" style="margin:0">التفاصيل {!! $arrow !!}</span>
      </a>
      @endif
    </div>
    <div class="sect-more reveal">
      <a href="{{ route('applications') }}" class="btn btn-grad">كل التطبيقات {!! $arrow !!}</a>
    </div>
  </div>
</section>

<!-- VISION -->
<section id="vision">
  <div class="wrap">
    <div class="reveal">
      <span class="eyebrow"><span class="dot"></span>Critical Technology</span>
      <h2 class="sect-title">رؤية <span class="grad-text">المستقبل</span></h2>
      <p class="sect-lead">الابتكار ليس مجرد نجاح علمي، بل رافعة تكنولوجية استراتيجية قادرة على نقل الاقتصاد المصري من تصنيع الخام منخفض القيمة، إلى اقتصاد قائم على التكنولوجيا الفائقة والمعرفة.</p>
    </div>
    <div class="grid axis-grid" style="margin-top:40px">
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
    <div class="sect-more reveal">
      <a href="{{ route('vision') }}" class="btn btn-grad"> رؤية المستقبل  {!! $arrow !!}</a>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section id="features">
  <div class="wrap">
    <div class="reveal">
      <span class="eyebrow"><span class="dot"></span>The Masterpiece</span>
      <h2 class="sect-title">المميزات</h2>
      <p class="sect-lead">ما الذي يجعل المادة المبتكرة "الأفضل على الإطلاق"؟ مزيج من العبقرية الكيميائية والجدوى الاقتصادية لا تملكه أي مادة منافسة.</p>
    </div>
    <div class="grid feat-grid" style="margin-top:40px">
      @foreach($features as $f)
      <div class="feat card reveal"><div class="ic">{!! $featSvg[$f->icon] ?? $featSvg['star'] !!}</div><h3>{{ $f->title }}</h3><p>{{ $f->body }}</p></div>
      @endforeach
    </div>
    <div class="sect-more reveal">
      <a href="{{ route('features') }}" class="btn btn-grad"> المميزات  {!! $arrow !!}</a>
    </div>
  </div>
</section>

<!-- CTA -->
<div class="cta-band"><div class="wrap"><div class="inner reveal">
  <div><h3>مهتم بشراكة أو بالتفاصيل التقنية؟</h3><p>فريقنا جاهز للرد على استفساراتك حول الابتكار وتطبيقاته الصناعية.</p></div>
  <a href="#contact" class="btn btn-grad">تواصل معنا الآن
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
</div></div></div>

<!-- CONTACT -->
<section id="contact">
  <div class="wrap">
    <div class="reveal">
      <span class="eyebrow"><span class="dot"></span>Contact</span>
      <h2 class="sect-title">تواصل <span class="grad-text">معنا</span></h2>
    </div>
    <div class="contact-grid" style="margin-top:40px">
      <div class="cinfo reveal">
        <div class="head">شركة {{ $S['site_name'] ?? 'Bio Graphene' }}<br><span style="font-weight:600;color:var(--muted);font-size:.95rem">إحدى شركات مجموعة <a href="{{ $mining }}" target="_blank" rel="noopener" class="mining-link">Mining Earth</a></span></div>
        <div class="crow">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V8l7-5 7 5v13M9 21v-6h6v6"/></svg></div>
          <div><div class="lbl">المصنع</div><div class="val">{{ $S['contact_factory'] ?? '' }}</div></div>
        </div>
        <div class="crow">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 12-9 12s-9-5-9-12a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
          <div><div class="lbl">المقر الإداري</div><div class="val">{{ $S['contact_hq'] ?? '' }}</div></div>
        </div>
        <div class="crow">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012 4.2 2 2 0 014 2h3a2 2 0 012 1.7c.1.9.3 1.8.7 2.6a2 2 0 01-.5 2.1L8 9.6a16 16 0 006 6l1.2-1.2a2 2 0 012.1-.4c.8.3 1.7.5 2.6.6a2 2 0 011.7 2z"/></svg></div>
          <div><div class="lbl">موبايل</div><div class="val"><span class="num">{{ $S['contact_mobile_local'] ?? '' }}</span> <span class="tag">(داخل مصر)</span><br><span class="num">{{ $S['contact_mobile_intl'] ?? '' }}</span> <span class="tag">(خارج مصر)</span></div></div>
        </div>
        <div class="crow">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.4 8.4 0 01-12.3 7.4L3 21l2.2-5.6A8.4 8.4 0 1121 11.5z"/></svg></div>
          <div><div class="lbl">واتساب</div><div class="val"><span class="num">{{ $S['contact_whatsapp_local'] ?? '' }}</span> <span class="tag">(داخل مصر)</span><br><span class="num">{{ $S['contact_whatsapp_intl'] ?? '' }}</span> <span class="tag">(خارج مصر)</span></div></div>
        </div>
        <div class="crow">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 6 10-6"/></svg></div>
          <div><div class="lbl">البريد الإلكتروني</div><div class="val"><a href="mailto:{{ $S['contact_email'] ?? '' }}" style="color:var(--cyan)" class="num">{{ $S['contact_email'] ?? '' }}</a></div></div>
        </div>
      </div>

      <form class="cform reveal" method="POST" action="{{ route('contact.store') }}">
        @csrf
        @if(session('sent'))
          <div class="form-msg" style="display:block">تم استلام رسالتك — سنرد عليك في أقرب وقت.</div>
        @endif
        <div><label for="nm">الاسم</label><input id="nm" name="name" type="text" value="{{ old('name') }}" placeholder="اسمك الكامل" required>
          @error('name')<span style="color:#ff8a89;font-size:.8rem">{{ $message }}</span>@enderror</div>
        <div><label for="em">البريد أو الهاتف</label><input id="em" name="contact" type="text" value="{{ old('contact') }}" placeholder="وسيلة للتواصل معك"></div>
        <div><label for="ms">رسالتك</label><textarea id="ms" name="message" placeholder="اكتب استفسارك هنا..." required>{{ old('message') }}</textarea>
          @error('message')<span style="color:#ff8a89;font-size:.8rem">{{ $message }}</span>@enderror</div>
        <button class="btn btn-grad" style="justify-content:center" type="submit">إرسال الرسالة</button>
        <a class="wa-btn" href="https://wa.me/{{ $S['contact_whatsapp_link'] ?? '' }}" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 00-8.6 15l-1.3 4.7 4.8-1.3A10 10 0 1012 2zm5.8 14.2c-.2.7-1.4 1.3-2 1.4-.5.1-1.2.1-1.9-.1-.4-.1-1-.3-1.7-.6-3-1.3-4.9-4.3-5.1-4.5-.1-.2-1.2-1.5-1.2-2.9s.7-2 1-2.3c.2-.3.5-.3.7-.3h.5c.2 0 .4 0 .6.5l.8 2c.1.2.1.3 0 .5l-.4.6-.3.3c-.1.2-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1 2.1 1.4 2.4 1.5.2.1.4.1.5-.1l.7-.9c.2-.2.4-.2.6-.1l2 .9c.2.1.4.2.4.3.1.1.1.6-.1 1.2z"/></svg>
          محادثة واتساب مباشرة
        </a>
      </form>
    </div>
  </div>
</section>
</main>
@endsection
