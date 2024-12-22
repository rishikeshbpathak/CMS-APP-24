<?php

namespace App\Http\Controllers;

use App\Models\Page;


class PageController extends Controller
{

    public function index()
    {
        $pages = Page::with('children')->whereNull('parent_id')->get();
        $pages = $pages->map(function ($page) {
            return $this->formatPage($page);
        });
        return response()->json($pages);
    }

    public function showPageViewer()
    {
        return view('page-viewer');
    }


public function show($slug)
{

    $slugs = explode('/', $slug);
    $url_slug = implode('/', $slugs);
    $pageQuery = Page::where('slug', array_pop($slugs));
    $page = $pageQuery->first();
    if (empty($page)) {
        abort(404, 'Page not found');
    }
    return view('page', ['page' => $page,'url_slug' => $url_slug]);
}


    private function formatPage($page)
    {
        return [
            'id' => $page->id,
            'slug' => $page->slug,
            'title' => $page->title,
            'children' => $page->children->map(function ($child) {
                return $this->formatPage($child);
            })
        ];
    }
}
