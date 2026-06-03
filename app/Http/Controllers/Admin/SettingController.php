<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings', ['s' => SiteSetting::pluck('value', 'key')]);
    }

    public function update(Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return back()->with('ok', 'تم حفظ الإعدادات.');
    }
}
