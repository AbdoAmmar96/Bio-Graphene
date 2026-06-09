<?php
namespace App\Http\Controllers;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'contact' => 'nullable|string|max:160',
            'message' => 'required|string|max:4000',
        ]);

        // 1) احفظها في لوحة التحكم
        ContactMessage::create($data);

        // 2) ابعت نسخة على بريد الإدارة (نفس بريد Mining Earth / Bio-Graphene)
        $to = SiteSetting::get('contact_email', 'info@miningearth.com');
        if ($to) {
            try {
                Mail::raw(
                    "رسالة جديدة من موقع Bio-Graphene\n\n".
                    "الاسم: {$data['name']}\n".
                    "وسيلة التواصل: ".($data['contact'] ?: '—')."\n\n".
                    "الرسالة:\n{$data['message']}",
                    function ($m) use ($to, $data) {
                        $m->to($to)
                          ->subject('رسالة تواصل جديدة — '.$data['name']);
                        if (!empty($data['contact']) && filter_var($data['contact'], FILTER_VALIDATE_EMAIL)) {
                            $m->replyTo($data['contact'], $data['name']);
                        }
                    }
                );
            } catch (\Throwable $e) {
                // لو فشل الإرسال (SMTP غير مضبوط) لا نُفشل الطلب — الرسالة محفوظة بالفعل في الداشبورد
                Log::warning('Contact email failed: '.$e->getMessage());
            }
        }

        return back()->with('sent', true)->withFragment('contact');
    }
}
