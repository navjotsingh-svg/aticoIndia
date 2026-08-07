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
            'industrySlides' => $this->buildIndustrySlides($groups),
            'groups' => $groups,
        ]);
    }

    /**
     * Naugra-style hero slides using group data with Atico fallbacks.
     *
     * @param  \Illuminate\Support\Collection|array<int, mixed>  $groups
     * @return array<int, array{title: string, subtitle: string, description: string, image: string, url: string}>
     */
    private function buildIndustrySlides($groups): array
    {
        $fallbackImages = [
            'assets/frontend/images/Bio-2-Image1.webp',
            'assets/frontend/images/civil-1-Image1.webp',
            'assets/frontend/images/elec-testing-Image1.webp',
            'assets/frontend/images/microscope-2-Image1.webp',
        ];

        $fallbackSlides = [
            [
                'title' => 'Educational',
                'subtitle' => 'Laboratory Equipments',
                'description' => 'Scientific lab equipments, biology lab equipments, chemistry lab equipments, school laboratory glassware, school laboratory plasticware, mathematics lab kits and more.',
                'url' => route('categories.index'),
            ],
            [
                'title' => 'Civil Engineering',
                'subtitle' => 'Laboratory Equipments',
                'description' => 'Civil engineering lab equipments including thermodynamics, fluid mechanics, construction equipment, concrete training lab equipments and surveying technology training lab equipments.',
                'url' => route('categories.index'),
            ],
            [
                'title' => 'Electrical Engineering',
                'subtitle' => 'Laboratory Equipments',
                'description' => 'Electrical engineering lab equipments including data acquisition systems, oscilloscopes, IC testers, digital storage oscilloscopes, signal generators and electrical training systems.',
                'url' => route('categories.index'),
            ],
            [
                'title' => 'Scientific',
                'subtitle' => 'Laboratory Instruments',
                'description' => 'Microscopes, physics lab equipments, analytical instruments and research-grade scientific laboratory instruments for schools, colleges and universities.',
                'url' => route('categories.index'),
            ],
        ];

        if (! empty($groups) && count($groups) > 0) {
            return collect($groups)->take(7)->values()->map(function ($group, int $index) use ($fallbackImages) {
                $name = trim(strip_tags((string) ($group->name ?? 'Laboratory Equipments')));
                $parts = preg_split('/\s+/', $name, 2) ?: [$name, ''];
                $image = (string) ($group->image ?? '');

                if ($image !== '') {
                    $imagePath = str_starts_with($image, 'http')
                        ? $image
                        : ltrim(str_contains($image, '/') ? $image : 'uploads/product_images/'.$image, '/');
                } else {
                    $imagePath = $fallbackImages[$index % count($fallbackImages)];
                }

                $description = trim(strip_tags((string) ($group->meta_description ?? '')));

                return [
                    'title' => $parts[0] ?? $name,
                    'subtitle' => $parts[1] !== '' ? $parts[1] : 'Laboratory Equipments',
                    'description' => $description !== ''
                        ? $description
                        : 'Explore our range of premium quality laboratory instruments and equipment manufactured and supplied by Atico India.',
                    'image' => $imagePath,
                    'url' => groupMenuUrl($group),
                ];
            })->all();
        }

        return collect($fallbackSlides)->map(function (array $slide, int $index) use ($fallbackImages) {
            $slide['image'] = $fallbackImages[$index % count($fallbackImages)];

            return $slide;
        })->all();
    }

    public function about()
    {
        return view('about');
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
