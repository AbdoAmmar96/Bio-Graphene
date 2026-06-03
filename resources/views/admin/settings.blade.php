@extends('layouts.admin')
@section('title', 'إعدادات الموقع')
@section('sub', 'النصوص الرئيسية وبيانات التواصل — تظهر مباشرة في الموقع')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}">
  @csrf @method('PUT')

  <div class="panel">
    <h2>الهيدر والهيرو</h2>
    <div class="field"><label>اسم الموقع</label><input name="site_name" value="{{ $s['site_name'] ?? '' }}"></div>
    <div class="field"><label>العنوان الفرعي (Eyebrow)</label><input name="hero_eyebrow" value="{{ $s['hero_eyebrow'] ?? '' }}"></div>
    <div class="field"><label>وصف الهيرو</label><textarea name="hero_desc">{{ $s['hero_desc'] ?? '' }}</textarea></div>
    <div class="field"><label>سطر الفريق</label><textarea name="hero_team">{{ $s['hero_team'] ?? '' }}</textarea></div>
    <div class="field"><label>الشعار/التاجلاين</label><input name="hero_tagline" value="{{ $s['hero_tagline'] ?? '' }}"></div>
    <div class="field"><label>اقتباس الرسالة (Mission)</label><textarea name="mission_quote">{{ $s['mission_quote'] ?? '' }}</textarea></div>
    <div class="field"><label>رابط Mining Earth</label><input name="mining_url" value="{{ $s['mining_url'] ?? '' }}" dir="ltr"></div>
  </div>

  <div class="panel">
    <h2>بيانات التواصل</h2>
    <div class="grid2">
      <div class="field"><label>المصنع</label><input name="contact_factory" value="{{ $s['contact_factory'] ?? '' }}"></div>
      <div class="field"><label>المقر الإداري</label><input name="contact_hq" value="{{ $s['contact_hq'] ?? '' }}"></div>
      <div class="field"><label>موبايل (داخل مصر)</label><input name="contact_mobile_local" value="{{ $s['contact_mobile_local'] ?? '' }}" dir="ltr"></div>
      <div class="field"><label>موبايل (خارج مصر)</label><input name="contact_mobile_intl" value="{{ $s['contact_mobile_intl'] ?? '' }}" dir="ltr"></div>
      <div class="field"><label>واتساب (داخل مصر)</label><input name="contact_whatsapp_local" value="{{ $s['contact_whatsapp_local'] ?? '' }}" dir="ltr"></div>
      <div class="field"><label>واتساب (خارج مصر)</label><input name="contact_whatsapp_intl" value="{{ $s['contact_whatsapp_intl'] ?? '' }}" dir="ltr"></div>
      <div class="field"><label>رقم رابط واتساب (wa.me/...)</label><input name="contact_whatsapp_link" value="{{ $s['contact_whatsapp_link'] ?? '' }}" dir="ltr"><div class="hint">الأرقام فقط، مثل: 201113736084</div></div>
      <div class="field"><label>البريد الإلكتروني</label><input name="contact_email" value="{{ $s['contact_email'] ?? '' }}" dir="ltr"></div>
    </div>
  </div>

  <div class="panel">
    <h2>الفوتر</h2>
    <div class="field"><label>نبذة الفوتر</label><textarea name="footer_about">{{ $s['footer_about'] ?? '' }}</textarea></div>
  </div>

  <div class="panel">
    <h2>الأقسام</h2>
    <input type="hidden" name="gallery_enabled" value="0">
    <label class="check"><input type="checkbox" name="gallery_enabled" value="1" @checked(($s['gallery_enabled'] ?? '1') === '1')> إظهار «معرض الصور» في الموقع (التبويب والصفحة)</label>
    <div class="hint">عند الإخفاء يختفي تبويب المعرض من القائمة وتتعطّل صفحته.</div>
  </div>

  <button class="btn btn-grad" type="submit">حفظ الإعدادات</button>
</form>
@endsection
