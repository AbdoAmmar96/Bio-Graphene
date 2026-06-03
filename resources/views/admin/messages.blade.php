@extends('layouts.admin')
@section('title', 'الرسائل')
@section('sub', 'الرسائل الواردة من نموذج «تواصل معنا»')

@section('content')
<div class="panel">
  <h2>كل الرسائل ({{ $items->count() }})</h2>
  @if($items->isEmpty())
    <p class="muted">لا توجد رسائل بعد.</p>
  @else
  <table>
    <thead><tr><th>الحالة</th><th>الاسم</th><th>التواصل</th><th>الرسالة</th><th>التاريخ</th><th>إجراءات</th></tr></thead>
    <tbody>
      @foreach($items as $item)
      <tr>
        <td>@if($item->is_read)<span class="tag green">مقروءة</span>@else<span class="tag unread">جديدة</span>@endif</td>
        <td>{{ $item->name }}</td>
        <td class="muted" dir="ltr" style="text-align:right">{{ $item->contact ?: '—' }}</td>
        <td class="muted" style="max-width:340px">{{ $item->message }}</td>
        <td class="muted">{{ $item->created_at->format('Y/m/d H:i') }}</td>
        <td><div class="actions">
          <form method="POST" action="{{ route('admin.messages.read', $item) }}">@csrf @method('PATCH')<button class="btn btn-ghost btn-sm">{{ $item->is_read ? 'تحديد كجديدة' : 'تحديد كمقروءة' }}</button></form>
          <form method="POST" action="{{ route('admin.messages.destroy', $item) }}" onsubmit="return confirm('حذف الرسالة؟')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">حذف</button></form>
        </div></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
</div>
@endsection
