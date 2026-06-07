<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', ($S['site_name'] ?? 'Bio-Graphene').' | منصة تقنية نانوية شاملة')</title>
<meta name="description" content="@yield('desc', $S['hero_desc'] ?? '')">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Tajawal:wght@400;500;700&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
@php($mining = $S['mining_url'] ?? 'https://www.miningearth.com')
@php($galleryOn = ($S['gallery_enabled'] ?? '1') === '1')
<header id="header">
  <div class="wrap nav">
    <a href="{{ url('/') }}" class="logo"><img src="{{ asset('images/logo-mark.png') }}" alt="Bio-Graphene" class="logo-mark"><span>Bio<span class="grad-text">Graphene</span></span></a>
    <nav class="nav-links">
      <a href="{{ route('material') }}">المادة المبتكرة</a>
      <a href="{{ route('applications') }}">التطبيقات</a>
      <a href="{{ route('vision') }}">رؤية المستقبل</a>
      <a href="{{ route('features') }}">المميزات</a>
      @if($galleryOn)<a href="{{ route('gallery') }}">معرض الصور</a>@endif
    </nav>
    <div class="nav-cta">
      <a href="{{ $mining }}" target="_blank" rel="noopener" class="ext"><span class="grad-text">Mining Earth</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17L17 7M17 7H8M17 7v9"/></svg></a>
      <a href="{{ url('/') }}#contact" class="btn btn-grad">تواصل معنا</a>
      <button class="burger" id="burger" aria-label="القائمة"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>
<div class="mobile-panel" id="mobilePanel">
  <a href="{{ route('material') }}">المادة المبتكرة</a>
  <a href="{{ route('applications') }}">التطبيقات</a>
  <a href="{{ route('vision') }}">رؤية المستقبل</a>
  <a href="{{ route('features') }}">المميزات</a>
  @if($galleryOn)<a href="{{ route('gallery') }}">معرض الصور</a>@endif
  <a href="{{ $mining }}" target="_blank" rel="noopener" class="ext"><span class="grad-text">Mining Earth</span> ↗</a>
</div>

@yield('content')

<footer>
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <a href="{{ url('/') }}" class="logo"><img src="{{ asset('images/logo-mark.png') }}" alt="Bio-Graphene" class="logo-mark"><span>Bio<span class="grad-text">Graphene</span></span></a>
        <p>{{ $S['footer_about'] ?? '' }}</p>
      </div>
      <div class="foot-col">
        <h4>روابط سريعة</h4>
        <a href="{{ route('material') }}">المادة المبتكرة</a>
        <a href="{{ route('applications') }}">التطبيقات</a>
        <a href="{{ route('vision') }}">رؤية المستقبل</a>
        <a href="{{ route('features') }}">المميزات</a>
      </div>
      <div class="foot-col">
        <h4>تواصل</h4>
        @if($galleryOn)<a href="{{ route('gallery') }}">معرض الصور</a>@endif
        <a href="{{ url('/') }}#contact">تواصل معنا</a>
        <a href="mailto:{{ $S['contact_email'] ?? '' }}">{{ $S['contact_email'] ?? '' }}</a>
        <a href="{{ $mining }}" target="_blank" rel="noopener" class="ext"><span class="grad-text">Mining Earth</span> ↗</a>
      </div>
    </div>
    <div class="copyright">
      © {{ date('Y') }} <a href="#">شركة شريك الأعمال لتقنية المعلومات</a>. جميع الحقوق محفوظة.
    </div>
  </div>
</footer>
<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
