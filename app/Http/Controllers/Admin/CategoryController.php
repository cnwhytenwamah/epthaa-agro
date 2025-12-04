<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\CategoryService;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends BaseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        if ($request->has('search') && $request->search) {
            $categories = $this->categoryService->searchCategories($request->search);
        } else {
            $categories = $this->categoryService->getCategoriesWithProductCount();
        }

        $statistics = $this->categoryService->getCategoryStatistics();

        return view('admin.categories.index', compact('categories', 'statistics'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    // ✅ FIXED
    public function store(CategoryFormRequest $request)
    {
        try {
            // ✅ Pass the request, not an array
            $this->categoryService->createCategory($request);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to create category: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $category = $this->categoryService->findCategory($id);

        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categoryService->findCategory($id);

        return view('admin.categories.edit', compact('category'));
    }

    // ✅ FIXED
    public function update(CategoryFormRequest $request, $id)
    {
        try {
            // ✅ Pass the request, not an array
            $this->categoryService->updateCategory($id, $request);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update category: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryService->deleteCategory($id);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $this->categoryService->toggleCategoryStatus($id);

            return redirect()
                ->back()
                ->with('success', 'Category status updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to update status: ' . $e->getMessage());
        }
    }
}
