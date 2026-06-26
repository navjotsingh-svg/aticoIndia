<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::query()
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->latest('id')
            ->paginate(12);

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

        return view('blog.index', compact('blogs', 'groups'));
    }

    public function show(string $slug)
    {
        $blog = Blog::query()
            ->whereNull('deleted_at')
            ->where('slug', $slug)
            ->firstOrFail();

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

        return view('blog.show', compact('blog', 'groups'));
    }
}
