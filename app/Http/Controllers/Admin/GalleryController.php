<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\GalleryFolder;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $r)
    {
        $folders = GalleryFolder::orderBy('sort')->with('images')->get();

        // الفولدر المفتوح حاليًا (افتراضيًا أول فولدر)
        $current = null;
        if ($r->filled('folder')) {
            $current = $folders->firstWhere('id', (int) $r->input('folder'));
        }
        $current ??= $folders->first();

        return view('admin.gallery', [
            'folders' => $folders,
            'current' => $current,
            'loose'   => GalleryImage::whereNull('folder_id')->orderBy('sort')->get(),
        ]);
    }

    /* ---------------- الفولدرات ---------------- */

    public function storeFolder(Request $r)
    {
        $data = $r->validate(['title' => 'required|string|max:120']);
        $folder = GalleryFolder::create([
            'title' => $data['title'],
            'slug'  => $this->uniqueSlug($data['title']),
            'sort'  => (GalleryFolder::max('sort') ?? 0) + 1,
        ]);
        return redirect()->route('admin.gallery.index', ['folder' => $folder->id])
            ->with('ok', 'تم إنشاء الفولدر.');
    }

    public function renameFolder(Request $r, GalleryFolder $folder)
    {
        $data = $r->validate(['title' => 'required|string|max:120']);
        $folder->update(['title' => $data['title']]);
        return back()->with('ok', 'تم تعديل اسم الفولدر.');
    }

    public function destroyFolder(GalleryFolder $folder)
    {
        // احذف صور الفولدر من القرص ثم الفولدر
        foreach ($folder->images as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }
        $folder->delete();
        return redirect()->route('admin.gallery.index')->with('ok', 'تم حذف الفولدر وصوره.');
    }

    public function sortFolders(Request $r)
    {
        foreach ((array) $r->input('order', []) as $i => $id) {
            GalleryFolder::where('id', (int) $id)->update(['sort' => $i]);
        }
        return response()->json(['ok' => true]);
    }

    /* ---------------- الصور ---------------- */

    public function store(Request $r)
    {
        $r->validate([
            'folder_id' => 'required|exists:gallery_folders,id',
            'images'    => 'required|array',
            'images.*'  => 'image|max:5120',
        ]);

        $start = (GalleryImage::where('folder_id', $r->folder_id)->max('sort') ?? 0) + 1;
        foreach ($r->file('images') as $i => $file) {
            $path = $file->store('gallery', 'public');
            GalleryImage::create([
                'folder_id' => $r->folder_id,
                'path'      => $path,
                'sort'      => $start + $i,
            ]);
        }
        return redirect()->route('admin.gallery.index', ['folder' => $r->folder_id])
            ->with('ok', 'تم رفع الصور.');
    }

    public function updateImage(Request $r, GalleryImage $image)
    {
        $data = $r->validate(['caption' => 'nullable|string|max:200']);
        $image->update(['caption' => $data['caption'] ?? null]);
        return back()->with('ok', 'تم تعديل الاسم.');
    }

    public function destroy(GalleryImage $image)
    {
        $folderId = $image->folder_id;
        Storage::disk('public')->delete($image->path);
        $image->delete();
        return redirect()->route('admin.gallery.index', ['folder' => $folderId])
            ->with('ok', 'تم حذف الصورة.');
    }

    public function sortImages(Request $r)
    {
        foreach ((array) $r->input('order', []) as $i => $id) {
            GalleryImage::where('id', (int) $id)->update(['sort' => $i]);
        }
        return response()->json(['ok' => true]);
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'folder';
        $slug = $base;
        $n = 2;
        while (GalleryFolder::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$n++;
        }
        return $slug;
    }
}
