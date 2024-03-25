<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Hero;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Suggestion;
use App\Models\Vision;
use App\Models\Washing;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function privacy_policy()
    {
        return view('front.privacy_policy');
    }

    public function about()
    {
        $about = About::first();
        $visions = Vision::all();
        return view('front.about', compact('visions','about'));
    }

    public function changeLocale($locale)
    {

        session()->put('lang', $locale);
        return redirect()->back();

    }

    public function welcome()
    {
        $statistics = Statistic::all();
        $blogs = Blog::all();
        $services = Service::all();
        $suggestions = Suggestion::all();
        $heroes = Hero::all();
        return view('front.welcome', compact('blogs','services','suggestions','heroes','statistics'));
    }

    public function services()
    {
        $services = Service::all();
        return view('front.services', compact('services'));
    }

    public function blogs()
    {
        $blogs = Blog::paginate(12);
        return view('front.blogs', compact('blogs'));
    }

    public function branches(Request $request)
    {

        $query = $request->input('search');

        $branches = Washing::where('status', true)
            ->when($query, function ($q) use ($query) {
            $q->where('washing_name', 'like', "%{$query}%");
        })->paginate(12);

        return view('front.branches', compact('branches'));

    }



    public function dynamicPage($slug)
    {

        $blog = Blog::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();

        if ($blog) {
            $routes = collect($blog->getTranslationsArray())->map(fn ($tr) => $tr['slug'])->toArray();
            $this->createTranslatedLinks($routes, 'dynamic.page');
            $blogs = Blog::all();
            return view('front.blog_single', compact('blog','blogs'));
        }

        $service = Service::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();

        if ($service) {
            $services = Service::take(5)->get();
            $routes = collect($service->getTranslationsArray())->map(fn ($tr) => $tr['slug'])->toArray();
            $this->createTranslatedLinks($routes, 'dynamic.page');
            return view('front.service_single', compact('service','services'));
        }



        abort(404);
    }

}
