<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(){ return view('admin.applications.index', ['items' => Application::orderBy('sort')->get()]); }
    public function create(){ return view('admin.applications.form', ['item' => new Application()]); }
    public function edit(Application $application){ return view('admin.applications.form', ['item' => $application]); }
    public function store(Request $r){ Application::create($this->data($r)); return redirect()->route('admin.applications.index')->with('ok','تمت الإضافة.'); }
    public function update(Request $r, Application $application){ $application->update($this->data($r)); return redirect()->route('admin.applications.index')->with('ok','تم التحديث.'); }
    public function destroy(Application $application){ $application->delete(); return back()->with('ok','تم الحذف.'); }
    private function data(Request $r){ $d = $r->validate([
        'slug'=>'required|alpha_dash','name'=>'required|string','symbol'=>'nullable|string',
        'icon'=>'required|string','short'=>'nullable|string','body'=>'nullable|string',
        'file_url'=>'nullable|string','sort'=>'nullable|integer',
    ]); $d['is_overview'] = $r->boolean('is_overview'); return $d; }
}
