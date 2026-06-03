@extends('layouts.admin')
@section('title', 'معرض الصور')
@section('sub', 'ارفع صور المعمل والإنتاج — تظهر في قسم «معرض الصور»')

@section('content')
<div class="panel">
  <h2>رفع صورة جديدة</h2>
  <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="grid2">
      <div class="field"><label>الصورة (JPG/PNG/WebP — حتى 5MB)</label><input type="file" name="image" accept="image/*" required>@error('image')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>وصف (اختياري)</label><input name="caption" placeholder="مثال: مرحلة التحلل الحراري"></div>
    </div>
    <button class="btn btn-grad" type="submit">رفع الصورة</button>
  </form>
</div>

<div class="panel">
  <h2>الصور الحالية ({{ $items->count() }})</h2>
  @if($items->isEmpty())
    <p class="muted">لا توجد صور بعد — الموقع يعرض «صورة قريبًا» مكانها.</p>
  @else
  <div class="gal">
    @foreach($items as $item)
    <div class="cell">
      <img src="{{ asset('storage/'.$item->path) }}" alt="{{ $item->caption }}">
      <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" onsubmit="return confirm('حذف الصورة؟')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">حذف</button></form>
    </div>
    @endforeach
  </div>
  @endif
</div>
@endsection
