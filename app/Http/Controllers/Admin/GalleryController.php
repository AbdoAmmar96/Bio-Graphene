<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(){ return view('admin.gallery', ['items' => GalleryImage::orderBy('sort')->get()]); }

    public function store(Request $r)
    {
        $r->validate(['image' => 'required|image|max:5120', 'caption' => 'nullable|string']);
        $path = $r->file('image')->store('gallery', 'public');
        GalleryImage::create(['path' => $path, 'caption' => $r->input('caption'), 'sort' => GalleryImage::max('sort') + 1]);
        return back()->with('ok', 'تم رفع الصورة.');
    }

    public function destroy(GalleryImage $gallery)
    {
        Storage::disk('public')->delete($gallery->path);
        $gallery->delete();
        return back()->with('ok', 'تم حذف الصورة.');
    }
}
