@extends('layouts.admin')
@section('title', $item->exists ? 'تعديل: '.$item->title : 'إضافة نسخة جديدة')
@section('content')
<form method="POST" action="{{ $item->exists ? route('admin.materials.update', $item) : route('admin.materials.store') }}">
  @csrf @if($item->exists)@method('PUT')@endif
  <div class="panel">
    <div class="grid2">
      <div class="field"><label>العنوان</label><input name="title" value="{{ old('title', $item->title) }}" required>@error('title')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>المعرّف (slug)</label><input name="slug" value="{{ old('slug', $item->slug) }}" dir="ltr" required>@error('slug')<div class="err">{{ $message }}</div>@enderror</div>
    </div>
    <div class="field"><label>وصف مختصر (يظهر في البطاقة)</label><textarea name="short">{{ old('short', $item->short) }}</textarea></div>
    <div class="field"><label>المحتوى الكامل (HTML)</label><textarea name="body" class="code">{{ old('body', $item->body) }}</textarea><div class="hint">يُسمح بوسوم HTML: ‎&lt;h3&gt; &lt;p&gt; &lt;ul&gt;&lt;li&gt; &lt;strong&gt;</div></div>
    <div class="grid2">
      <div class="field"><label>رابط ملف (اختياري)</label><input name="file_url" value="{{ old('file_url', $item->file_url) }}" dir="ltr"></div>
      <div class="field"><label>الترتيب</label><input name="sort" type="number" value="{{ old('sort', $item->sort ?? 0) }}"></div>
    </div>
  </div>
  <div class="form-actions">
    <button class="btn btn-grad" type="submit">حفظ</button>
    <a href="{{ route('admin.materials.index') }}" class="btn btn-ghost">إلغاء</a>
  </div>
</form>
@endsection
