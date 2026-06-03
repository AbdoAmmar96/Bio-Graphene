@extends('layouts.admin')
@section('title', 'المميزات')
@section('sub', 'بطاقات قسم «المميزات»')
@section('content')
<div class="panel">
  <h2>المميزات <a href="{{ route('admin.features.create') }}" class="btn btn-grad btn-sm">+ إضافة ميزة</a></h2>
  <table>
    <thead><tr><th>الترتيب</th><th>الأيقونة</th><th>العنوان</th><th>إجراءات</th></tr></thead>
    <tbody>
      @forelse($items as $item)
      <tr>
        <td class="muted">{{ $item->sort }}</td>
        <td class="muted"><span class="sym">{{ $item->icon }}</span></td>
        <td>{{ $item->title }}</td>
        <td><div class="actions">
          <a href="{{ route('admin.features.edit', $item) }}" class="btn btn-ghost btn-sm">تعديل</a>
          <form method="POST" action="{{ route('admin.features.destroy', $item) }}" onsubmit="return confirm('متأكد من الحذف؟')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">حذف</button></form>
        </div></td>
      </tr>
      @empty
      <tr><td colspan="4" class="muted">لا توجد عناصر.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
