<?php
namespace App\Http\Controllers;
use App\Models\{Material, Application, VisionAxis, VisionStat, VisionDoc, Feature, GalleryImage, SiteSetting};

class HomeController extends Controller
{
    public function index()
    {
        return view('public.home', [
            'materials'    => Material::orderBy('sort')->get(),
            'apps'         => Application::cards()->get(),
            'overview'     => Application::where('is_overview', true)->first(),
            'axes'         => VisionAxis::orderBy('sort')->get(),
            'stats'        => VisionStat::orderBy('sort')->get(),
            'visionDocs'   => VisionDoc::orderBy('sort')->get(),
            'features'     => Feature::orderBy('sort')->get(),
        ]);
    }

    /* ---------- صفحات الأقسام الكاملة ---------- */

    public function materialPage()
    {
        return view('public.sections.material', [
            'materials' => Material::orderBy('sort')->get(),
            'intro'     => SiteSetting::get('material_intro_html', ''),
            'extras'    => SiteSetting::get('material_extras_html', ''),
        ]);
    }

    public function applicationsPage()
    {
        return view('public.sections.applications', [
            'apps'     => Application::cards()->get(),
            'overview' => Application::where('is_overview', true)->first(),
        ]);
    }

    public function visionPage()
    {
        return view('public.sections.vision', [
            'axes'       => VisionAxis::orderBy('sort')->get(),
            'stats'      => VisionStat::orderBy('sort')->get(),
            'visionDocs' => VisionDoc::orderBy('sort')->get(),
        ]);
    }

    public function featuresPage()
    {
        return view('public.sections.features', [
            'features' => Feature::orderBy('sort')->get(),
            'intro'    => SiteSetting::get('features_intro_html', ''),
        ]);
    }

    public function galleryPage()
    {
        abort_unless(SiteSetting::get('gallery_enabled', '1') === '1', 404);
        return view('public.sections.gallery', [
            'gallery' => GalleryImage::orderBy('sort')->get(),
        ]);
    }

    /* ---------- صفحات التفاصيل (المقالات) ---------- */

    public function application(string $slug)
    {
        $item = Application::where('slug', $slug)->firstOrFail();
        return view('public.detail', [
            'eyebrow' => 'التطبيقات', 'title' => $item->name,
            'subtitle' => $item->short, 'body' => $item->body,
            'fileUrl' => $item->file_url, 'backTo' => route('applications'),
        ]);
    }

    public function material(string $slug)
    {
        $item = Material::where('slug', $slug)->firstOrFail();
        return view('public.detail', [
            'eyebrow' => 'المادة المبتكرة', 'title' => $item->title,
            'subtitle' => $item->short, 'body' => $item->body,
            'fileUrl' => $item->file_url, 'backTo' => route('material'),
        ]);
    }

    public function visionDoc(string $slug)
    {
        $item = VisionDoc::where('slug', $slug)->firstOrFail();
        return view('public.detail', [
            'eyebrow' => 'رؤية المستقبل', 'title' => $item->title,
            'subtitle' => $item->subtitle, 'body' => $item->body,
            'fileUrl' => $item->file_url, 'backTo' => route('vision'),
        ]);
    }
}
