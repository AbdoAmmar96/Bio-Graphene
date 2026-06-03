@extends('layouts.admin')
@section('title', 'التطبيقات')
@section('sub', 'بطاقات قسم «التطبيقات» الصناعية')
@section('content')
<div class="panel">
  <h2>التطبيقات <a href="{{ route('admin.applications.create') }}" class="btn btn-grad btn-sm">+ إضافة تطبيق</a></h2>
  <table>
    <thead><tr><th>الترتيب</th><th>الرمز</th><th>الاسم</th><th>النوع</th><th>إجراءات</th></tr></thead>
    <tbody>
      @forelse($items as $item)
      <tr>
        <td class="muted">{{ $item->sort }}</td>
        <td><span class="sym">{{ $item->symbol ?: '—' }}</span></td>
        <td>{{ $item->name }}</td>
        <td>@if($item->is_overview)<span class="tag green">نظرة عامة</span>@else<span class="muted">{{ $item->icon }}</span>@endif</td>
        <td><div class="actions">
          <a href="{{ route('admin.applications.edit', $item) }}" class="btn btn-ghost btn-sm">تعديل</a>
          <form method="POST" action="{{ route('admin.applications.destroy', $item) }}" onsubmit="return confirm('متأكد من الحذف؟')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">حذف</button></form>
        </div></td>
      </tr>
      @empty
      <tr><td colspan="5" class="muted">لا توجد عناصر.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
