@extends('layouts.admin')
@section('title', 'المادة المبتكرة')
@section('sub', 'نسخ المادة (الأساسية / V1 ...) — تظهر في قسم «المادة المبتكرة»')
@section('content')
<div class="panel">
  <h2>النسخ <a href="{{ route('admin.materials.create') }}" class="btn btn-grad btn-sm">+ إضافة نسخة</a></h2>
  <table>
    <thead><tr><th>الترتيب</th><th>العنوان</th><th>المعرّف</th><th>إجراءات</th></tr></thead>
    <tbody>
      @forelse($items as $item)
      <tr>
        <td class="muted">{{ $item->sort }}</td>
        <td>{{ $item->title }}</td>
        <td class="muted"><span class="sym">{{ $item->slug }}</span></td>
        <td><div class="actions">
          <a href="{{ route('admin.materials.edit', $item) }}" class="btn btn-ghost btn-sm">تعديل</a>
          <form method="POST" action="{{ route('admin.materials.destroy', $item) }}" onsubmit="return confirm('متأكد من الحذف؟')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">حذف</button></form>
        </div></td>
      </tr>
      @empty
      <tr><td colspan="4" class="muted">لا توجد عناصر.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
