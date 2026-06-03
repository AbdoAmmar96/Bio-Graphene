@extends('layouts.admin')
@section('title', $item->exists ? 'تعديل ميزة' : 'إضافة ميزة')
@section('content')
@php($icons = ['target','refresh','shield','leaf','magnet','scan','star','atom'])
<form method="POST" action="{{ $item->exists ? route('admin.features.update', $item) : route('admin.features.store') }}">
  @csrf @if($item->exists)@method('PUT')@endif
  <div class="panel">
    <div class="grid2">
      <div class="field"><label>الأيقونة</label>
        <select name="icon">@foreach($icons as $ic)<option value="{{ $ic }}" @selected(old('icon',$item->icon)==$ic)>{{ $ic }}</option>@endforeach</select>
        <div class="hint">target · refresh · shield · leaf · magnet · scan · star · atom</div>
      </div>
      <div class="field"><label>الترتيب</label><input name="sort" type="number" value="{{ old('sort', $item->sort ?? 0) }}"></div>
    </div>
    <div class="field"><label>العنوان</label><input name="title" value="{{ old('title', $item->title) }}" required>@error('title')<div class="err">{{ $message }}</div>@enderror</div>
    <div class="field"><label>الوصف</label><textarea name="body">{{ old('body', $item->body) }}</textarea></div>
  </div>
  <div class="form-actions">
    <button class="btn btn-grad" type="submit">حفظ</button>
    <a href="{{ route('admin.features.index') }}" class="btn btn-ghost">إلغاء</a>
  </div>
</form>
@endsection
