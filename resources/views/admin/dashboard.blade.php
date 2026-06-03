@extends('layouts.admin')
@section('title', 'لوحة المعلومات')
@section('sub', 'نظرة عامة على محتوى الموقع')

@section('content')
<div class="stats">
  <div class="stat-card"><div class="v">{{ $counts['applications'] }}</div><div class="l">تطبيق صناعي</div></div>
  <div class="stat-card"><div class="v">{{ $counts['materials'] }}</div><div class="l">نسخة من المادة</div></div>
  <div class="stat-card"><div class="v">{{ $counts['features'] }}</div><div class="l">ميزة</div></div>
  <div class="stat-card"><div class="v">{{ $counts['gallery'] }}</div><div class="l">صورة في المعرض</div></div>
</div>

<div class="panel">
  <h2>آخر الرسائل
    <a href="{{ route('admin.messages.index') }}" class="btn btn-ghost btn-sm">كل الرسائل</a>
  </h2>
  @if($messages->isEmpty())
    <p class="muted">لا توجد رسائل بعد.</p>
  @else
  <table>
    <thead><tr><th>الاسم</th><th>وسيلة التواصل</th><th>الرسالة</th><th>التاريخ</th><th></th></tr></thead>
    <tbody>
      @foreach($messages as $msg)
      <tr>
        <td>{{ $msg->name }} @unless($msg->is_read)<span class="tag unread">جديد</span>@endunless</td>
        <td class="muted">{{ $msg->contact ?: '—' }}</td>
        <td class="muted">{{ \Illuminate\Support\Str::limit($msg->message, 60) }}</td>
        <td class="muted">{{ $msg->created_at->diffForHumans() }}</td>
        <td><a href="{{ route('admin.messages.index') }}" class="btn btn-ghost btn-sm">عرض</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
</div>

<div class="panel">
  <h2>روابط سريعة</h2>
  <div class="actions" style="flex-wrap:wrap">
    <a href="{{ route('admin.applications.index') }}" class="btn btn-ghost">إدارة التطبيقات</a>
    <a href="{{ route('admin.vision.index') }}" class="btn btn-ghost">تعديل رؤية المستقبل</a>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-ghost">رفع صور للمعرض</a>
    <a href="{{ route('admin.settings.edit') }}" class="btn btn-ghost">إعدادات الموقع والتواصل</a>
  </div>
</div>
@endsection
