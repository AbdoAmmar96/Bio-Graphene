<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{VisionAxis, VisionStat, VisionDoc};
use Illuminate\Http\Request;

class VisionController extends Controller
{
    public function index()
    {
        return view('admin.vision', [
            'axes'  => VisionAxis::orderBy('sort')->get(),
            'stats' => VisionStat::orderBy('sort')->get(),
            'docs'  => VisionDoc::orderBy('sort')->get(),
        ]);
    }

    public function update(Request $r)
    {
        foreach ($r->input('axes', []) as $id => $row) {
            VisionAxis::where('id', $id)->update([
                'number' => $row['number'] ?? '', 'title' => $row['title'] ?? '', 'body' => $row['body'] ?? '',
            ]);
        }
        foreach ($r->input('stats', []) as $id => $row) {
            VisionStat::where('id', $id)->update(['value' => $row['value'] ?? '', 'label' => $row['label'] ?? '']);
        }
        foreach ($r->input('docs', []) as $id => $row) {
            VisionDoc::where('id', $id)->update([
                'title' => $row['title'] ?? '', 'subtitle' => $row['subtitle'] ?? '',
                'body' => $row['body'] ?? '', 'file_url' => $row['file_url'] ?? null,
            ]);
        }
        return back()->with('ok', 'تم حفظ قسم رؤية المستقبل.');
    }
}
