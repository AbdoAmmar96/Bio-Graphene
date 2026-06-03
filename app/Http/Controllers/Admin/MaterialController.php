<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(){ return view('admin.materials.index', ['items' => Material::orderBy('sort')->get()]); }
    public function create(){ return view('admin.materials.form', ['item' => new Material()]); }
    public function edit(Material $material){ return view('admin.materials.form', ['item' => $material]); }
    public function store(Request $r){ Material::create($this->data($r)); return redirect()->route('admin.materials.index')->with('ok','تمت الإضافة.'); }
    public function update(Request $r, Material $material){ $material->update($this->data($r)); return redirect()->route('admin.materials.index')->with('ok','تم التحديث.'); }
    public function destroy(Material $material){ $material->delete(); return back()->with('ok','تم الحذف.'); }
    private function data(Request $r){ return $r->validate([
        'slug'=>'required|alpha_dash','title'=>'required|string','short'=>'nullable|string',
        'body'=>'nullable|string','file_url'=>'nullable|string','sort'=>'nullable|integer',
    ]); }
}
