<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index(){ return view('admin.features.index', ['items' => Feature::orderBy('sort')->get()]); }
    public function create(){ return view('admin.features.form', ['item' => new Feature()]); }
    public function edit(Feature $feature){ return view('admin.features.form', ['item' => $feature]); }
    public function store(Request $r){ Feature::create($this->data($r)); return redirect()->route('admin.features.index')->with('ok','تمت الإضافة.'); }
    public function update(Request $r, Feature $feature){ $feature->update($this->data($r)); return redirect()->route('admin.features.index')->with('ok','تم التحديث.'); }
    public function destroy(Feature $feature){ $feature->delete(); return back()->with('ok','تم الحذف.'); }
    private function data(Request $r){ return $r->validate([
        'icon'=>'required|string','title'=>'required|string','body'=>'nullable|string','sort'=>'nullable|integer',
    ]); }
}
