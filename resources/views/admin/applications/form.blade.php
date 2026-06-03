@extends('layouts.admin')
@section('title', $item->exists ? 'تعديل: '.$item->name : 'إضافة تطبيق')
@section('content')
@php($icons = ['symbol' => 'رمز عنصر كبير (Cu, Li...)','symbolsm' => 'رمز صغير (Al₂O₃)','crystal' => 'أيقونة بلورة','water' => 'أيقونة ماء','grid' => 'أيقونة شبكة'])
<form method="POST" action="{{ $item->exists ? route('admin.applications.update', $item) : route('admin.applications.store') }}">
  @csrf @if($item->exists)@method('PUT')@endif
  <div class="panel">
    <div class="grid2">
      <div class="field"><label>الاسم</label><input name="name" value="{{ old('name', $item->name) }}" required>@error('name')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>المعرّف (slug)</label><input name="slug" value="{{ old('slug', $item->slug) }}" dir="ltr" required>@error('slug')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>الرمز (مثل Cu أو Li — اتركه فارغًا لو أيقونة)</label><input name="symbol" value="{{ old('symbol', $item->symbol) }}" dir="ltr"></div>
      <div class="field"><label>نوع الأيقونة</label>
        <select name="icon">@foreach($icons as $k => $label)<option value="{{ $k }}" @selected(old('icon',$item->icon ?? 'symbol')==$k)>{{ $label }}</option>@endforeach</select>
      </div>
    </div>
    <div class="field"><label>وصف مختصر (يظهر في البطاقة)</label><textarea name="short">{{ old('short', $item->short) }}</textarea></div>
    <div class="field"><label>المحتوى الكامل (HTML)</label><textarea name="body" class="code">{{ old('body', $item->body) }}</textarea><div class="hint">يُسمح بوسوم HTML: ‎&lt;h3&gt; &lt;p&gt; &lt;ul&gt;&lt;li&gt; &lt;strong&gt;</div></div>
    <div class="grid2">
      <div class="field"><label>رابط ملف (اختياري)</label><input name="file_url" value="{{ old('file_url', $item->file_url) }}" dir="ltr"></div>
      <div class="field"><label>الترتيب</label><input name="sort" type="number" value="{{ old('sort', $item->sort ?? 0) }}"></div>
    </div>
    <label class="check"><input type="checkbox" name="is_overview" value="1" @checked(old('is_overview', $item->is_overview)) > بطاقة «نظرة عامة» العريضة (التطبيقات الرئيسية)</label>
  </div>
  <div class="form-actions">
    <button class="btn btn-grad" type="submit">حفظ</button>
    <a href="{{ route('admin.applications.index') }}" class="btn btn-ghost">إلغاء</a>
  </div>
</form>
@endsection
