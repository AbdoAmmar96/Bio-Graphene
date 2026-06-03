@extends('layouts.admin')
@section('title', 'رؤية المستقبل')
@section('sub', 'المحاور الثلاثة + شريط الأرقام + مستندات (الأرباح / الرؤية)')

@section('content')
<form method="POST" action="{{ route('admin.vision.update') }}">
  @csrf @method('PUT')

  <div class="panel">
    <h2>المحاور</h2>
    @foreach($axes as $ax)
    <div class="grid2" style="border-bottom:1px solid var(--line);padding-bottom:6px;margin-bottom:14px">
      <div class="field"><label>الرقم</label><input name="axes[{{ $ax->id }}][number]" value="{{ $ax->number }}"></div>
      <div class="field"><label>العنوان</label><input name="axes[{{ $ax->id }}][title]" value="{{ $ax->title }}"></div>
      <div class="field" style="grid-column:1 / -1"><label>الوصف</label><textarea name="axes[{{ $ax->id }}][body]">{{ $ax->body }}</textarea></div>
    </div>
    @endforeach
  </div>

  <div class="panel">
    <h2>شريط الأرقام</h2>
    <div class="grid2">
      @foreach($stats as $st)
      <div class="field"><label>القيمة</label><input name="stats[{{ $st->id }}][value]" value="{{ $st->value }}" dir="ltr"></div>
      <div class="field"><label>الوصف</label><input name="stats[{{ $st->id }}][label]" value="{{ $st->label }}"></div>
      @endforeach
    </div>
  </div>

  <div class="panel">
    <h2>المستندات</h2>
    @foreach($docs as $d)
    <div style="border-bottom:1px solid var(--line);padding-bottom:6px;margin-bottom:16px">
      <div class="grid2">
        <div class="field"><label>العنوان</label><input name="docs[{{ $d->id }}][title]" value="{{ $d->title }}"></div>
        <div class="field"><label>العنوان الفرعي</label><input name="docs[{{ $d->id }}][subtitle]" value="{{ $d->subtitle }}"></div>
      </div>
      <div class="field"><label>المحتوى الكامل (HTML)</label><textarea name="docs[{{ $d->id }}][body]" class="code">{{ $d->body }}</textarea></div>
      <div class="field"><label>رابط ملف (اختياري)</label><input name="docs[{{ $d->id }}][file_url]" value="{{ $d->file_url }}" dir="ltr"></div>
    </div>
    @endforeach
  </div>

  <button class="btn btn-grad" type="submit">حفظ قسم رؤية المستقبل</button>
</form>
@endsection
