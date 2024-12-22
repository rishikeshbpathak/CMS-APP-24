<?php
// app/Http/Controllers/PageBackendController.php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageBackendController extends Controller
{
    // show page list in dashboard pages section
    public function index()
{
    $pages = Page::all();
    // $pages = Page::with('children')->whereNull('parent_id')->get();
    return view('backend-pages.show', compact('pages'));


}
// create new page
public function create()
{
    // $pages = Page::whereNull('parent_id')->get();
    $parents = Page::all();
    return view('backend-pages.create', compact('parents'));
}

// store new page in database
public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'slug' => 'required|unique:pages',
        'content' => 'required',
        'parent_id' => 'nullable|exists:pages,id'
    ]);

    Page::create($request->all());
    // aftert store redirect to pages index
    return redirect()->route('pages.index');
}
// edit page
public function edit(Page $page)
{
    // $parents = Page::whereNull('parent_id')->get();
    $parents = Page::all();
    return view('backend-pages.edit', compact('page', 'parents'));
}

// update page in database
public function update(Request $request, Page $page)
{
    $request->validate([
        'title' => 'required',
        'slug' => 'required|unique:pages,slug,' . $page->id,
        'content' => 'required',
        'parent_id' => 'nullable|exists:pages,id'
    ]);

    $page->update($request->all());
    return redirect()->route('pages.index');
}
// delete page from database
public function destroy(Page $page)
{
    $page->delete();
    return redirect()->route('pages.index');
}

}
