<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Application, Material, Feature, VisionDoc, GalleryImage, ContactMessage};

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'applications' => Application::count(),
                'materials'    => Material::count(),
                'features'     => Feature::count(),
                'visionDocs'   => VisionDoc::count(),
                'gallery'      => GalleryImage::count(),
                'unread'       => ContactMessage::where('is_read', false)->count(),
            ],
            'messages' => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}
