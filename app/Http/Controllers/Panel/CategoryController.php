<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Category\CreateCategoryRequest;
use App\Http\Requests\Panel\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->paginate(10);
        $parentsCategory = Category::where('parent_id', null)->get();
        return view('panel.Category.index', compact('categories', 'parentsCategory'));
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create($request->validated());
        return back()->with('success', 'دسته بندی با موفقیت ایجاد شد.');
    }

    public function edit(Category $category)
    {
        $categories = Category::paginate(1);
        $parentsCategory = Category::where('parent_id', null)->where('id', '!=', $category->id)->get();
        return view('panel.Category.edit',
            compact('category', 'parentsCategory', 'categories'));
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'دسته بندی با موفقیت بروزرسانی شد.');

    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return back()->with('success', 'آیتم مورد نظر با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
