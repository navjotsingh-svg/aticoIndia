<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $groups = \App\Models\Group::where('status', 1)->orderBy('sort', 'asc')->select('id', 'route', 'sort', 'name')->get();
        if(count($groups)>0){
            foreach ($groups as $key => $group) {
                $group['categories'] = \App\Models\GroupCategory::join('categories', 'group_categories.category_id', '=', 'categories.id')
                ->where('group_categories.group_id', $group->id)
                ->where('categories.status', 1)
                ->orderBy('categories.sort', 'asc')
                ->select('categories.id', 'categories.slug', 'categories.name', 'categories.short_name', 'categories.description', 'categories.image')
                ->get();

                foreach ($group['categories'] as $key => $sub_category) {
                    $sub_category['sub_categories'] = \App\Models\Category::where('parent_id', $sub_category->id)
                    ->where('status', 1)
                    ->orderBy('name', 'asc')
                    ->select('id', 'name', 'short_name', 'slug')
                    ->get();
                }
            }
        }

       // dd($groups);

        return view('home', [
            'featuredCategories' => Category::query()
                ->whereNull('deleted_at')
                ->where('status', 1)
                ->whereIn('parent_id', ['0', 0, null])
                ->orderBy('sort')
                ->limit(12)
                ->get(),
            'blogs' => Blog::query()
                ->whereNull('deleted_at')
                ->where('status', 1)
                ->latest('id')
                ->limit(4)
                ->get(),
            'heroSlides' => [
                'assets/frontend/images/Bio-2-Image1.webp',
                'assets/frontend/images/civil-1-Image1.webp',
                'assets/frontend/images/elec-testing-Image1.webp',
                'assets/frontend/images/microscope-2-Image1.webp',
            ],
            'groups' => $groups,
        ]);
    }

    public function faq()
    {
        $faqs = Faq::query()
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();

        return view('faq', compact('faqs'));
    }

    public function labTenders()
    {
        return view('lab-tenders');
    }

    public function contact()
    {
        return view('contact');
    }

    public function terms()
    {
        return view('terms-service');
    }

    public function certificates()
    {
        return view('certificates');
    }
}
