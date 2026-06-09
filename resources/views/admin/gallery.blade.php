@extends('layouts.admin')
@section('title', 'معرض الصور')
@section('sub', 'نظّم الصور في فولدرات — أنشئ، أعد التسمية، ارفع وارتّب بالسحب')

@section('content')
<div class="gallery-mgr">

  {{-- عمود الفولدرات --}}
  <aside class="gfolders">
    <div class="panel">
      <h2>الفولدرات</h2>

      @if($folders->isEmpty())
        <p class="muted" style="margin-bottom:14px">لا توجد فولدرات بعد. أنشئ أول فولدر للبدء.</p>
      @else
        <ul class="folder-list" id="folderList">
          @foreach($folders as $f)
          <li class="folder-item {{ $current && $current->id === $f->id ? 'active' : '' }}" data-id="{{ $f->id }}">
            <span class="drag" title="اسحب لإعادة الترتيب">⋮⋮</span>
            <a href="{{ route('admin.gallery.index', ['folder' => $f->id]) }}" class="fname">
              {{ $f->title }} <span class="cnt">{{ $f->images->count() }}</span>
            </a>
          </li>
          @endforeach
        </ul>
      @endif

      <form method="POST" action="{{ route('admin.gallery.folders.store') }}" class="add-folder">
        @csrf
        <input name="title" placeholder="اسم فولدر جديد…" required>
        <button class="btn btn-grad btn-sm" type="submit">+ إضافة</button>
        @error('title')<div class="err">{{ $message }}</div>@enderror
      </form>
    </div>
  </aside>

  {{-- محتوى الفولدر الحالي --}}
  <section class="gcontent">
    @if(!$current)
      <div class="panel"><p class="muted">اختر فولدرًا من اليمين أو أنشئ واحدًا لرفع الصور.</p></div>
    @else
      {{-- رأس الفولدر: تعديل الاسم + حذف --}}
      <div class="panel folder-head">
        <form method="POST" action="{{ route('admin.gallery.folders.rename', $current) }}" class="rename-folder">
          @csrf @method('PUT')
          <input name="title" value="{{ $current->title }}" aria-label="اسم الفولدر">
          <button class="btn btn-ghost btn-sm" type="submit">حفظ الاسم</button>
        </form>
        <form method="POST" action="{{ route('admin.gallery.folders.destroy', $current) }}"
              onsubmit="return confirm('حذف الفولدر «{{ $current->title }}» وكل صوره؟')">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm" type="submit">حذف الفولدر</button>
        </form>
      </div>

      {{-- رفع صور --}}
      <div class="panel">
        <h2>رفع صور إلى «{{ $current->title }}»</h2>
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="folder_id" value="{{ $current->id }}">
          <div class="field">
            <label>اختر صورة أو أكثر (JPG/PNG/WebP — حتى 5MB للصورة)</label>
            <input type="file" name="images[]" accept="image/*" multiple required>
            @error('images.*')<div class="err">{{ $message }}</div>@enderror
          </div>
          <button class="btn btn-grad" type="submit">رفع</button>
        </form>
      </div>

      {{-- الصور --}}
      <div class="panel">
        <h2>صور الفولدر ({{ $current->images->count() }})</h2>
        @if($current->images->isEmpty())
          <p class="muted">لا توجد صور في هذا الفولدر بعد.</p>
        @else
          <p class="hint" style="margin-bottom:14px">اسحب الصور لإعادة ترتيبها — يُحفظ الترتيب تلقائيًا.</p>
          <div class="gal" id="imageGrid">
            @foreach($current->images as $img)
            <div class="cell" data-id="{{ $img->id }}">
              <span class="drag" title="اسحب لإعادة الترتيب">⋮⋮</span>
              <img src="{{ asset('storage/'.$img->path) }}" alt="{{ $img->caption }}">
              <div class="cell-foot">
                <form method="POST" action="{{ route('admin.gallery.update', $img) }}" class="cap-form">
                  @csrf @method('PUT')
                  <label>اسم / وصف الصورة</label>
                  <input name="caption" value="{{ $img->caption }}" placeholder="اكتب اسمًا أو وصفًا…" maxlength="200">
                  <button class="btn btn-grad btn-sm" type="submit">حفظ الوصف</button>
                </form>
                <form method="POST" action="{{ route('admin.gallery.destroy', $img) }}" class="del-form" onsubmit="return confirm('حذف الصورة؟')">
                  @csrf @method('DELETE')
                  <button class="btn btn-danger btn-sm" type="submit">حذف الصورة</button>
                </form>
              </div>
            </div>
            @endforeach
          </div>
        @endif
      </div>
    @endif

    {{-- صور قديمة بدون فولدر (إن وُجدت) --}}
    @if($loose->isNotEmpty())
      <div class="panel">
        <h2>صور غير مصنّفة ({{ $loose->count() }})</h2>
        <p class="hint" style="margin-bottom:14px">صور قديمة قبل نظام الفولدرات. احذفها أو أعد رفعها داخل فولدر.</p>
        <div class="gal">
          @foreach($loose as $img)
          <div class="cell">
            <img src="{{ asset('storage/'.$img->path) }}" alt="{{ $img->caption }}">
            <form method="POST" action="{{ route('admin.gallery.destroy', $img) }}" class="loose-del" onsubmit="return confirm('حذف الصورة؟')">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" type="submit">حذف</button>
            </form>
          </div>
          @endforeach
        </div>
      </div>
    @endif
  </section>
</div>

<script>
(function () {
  const token = '{{ csrf_token() }}';

  function makeSortable(container, url) {
    if (!container) return;
    let dragEl = null;
    container.querySelectorAll('[data-id]').forEach(el => {
      el.setAttribute('draggable', 'true');
      el.addEventListener('dragstart', () => { dragEl = el; el.classList.add('dragging'); });
      el.addEventListener('dragend', () => { el.classList.remove('dragging'); save(); });
    });
    container.addEventListener('dragover', e => {
      e.preventDefault();
      if (!dragEl) return;
      const after = getAfter(container, e.clientY);
      if (after == null) container.appendChild(dragEl);
      else container.insertBefore(dragEl, after);
    });
    function getAfter(c, y) {
      const els = [...c.querySelectorAll('[data-id]:not(.dragging)')];
      return els.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        if (offset < 0 && offset > closest.offset) return { offset, element: child };
        return closest;
      }, { offset: -Infinity }).element || null;
    }
    function save() {
      const order = [...container.querySelectorAll('[data-id]')].map(el => el.dataset.id);
      fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({ order })
      });
    }
  }

  makeSortable(document.getElementById('imageGrid'), '{{ route('admin.gallery.sort') }}');
  makeSortable(document.getElementById('folderList'), '{{ route('admin.gallery.folders.sort') }}');
})();
</script>
@endsection
