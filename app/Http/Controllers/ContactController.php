<?php
namespace App\Http\Controllers;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'contact' => 'nullable|string|max:160',
            'message' => 'required|string|max:4000',
        ]);
        ContactMessage::create($data);
        return back()->with('sent', true)->withFragment('contact');
    }
}
