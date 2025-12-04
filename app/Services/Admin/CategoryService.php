<?php

namespace App\Services\Admin;

use Exception;
use App\Dto\CategoryDto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\Admin\AdminBaseService;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Http\Requests\CategoryFormRequest;

class CategoryService extends AdminBaseService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->all();
    }

    public function getPaginatedCategories($perPage = 15)
    {
        return $this->categoryRepository->paginate($perPage);
    }

    public function getCategoriesWithProductCount()
    {
        return $this->categoryRepository->getWithProductCount();
    }

    public function getActiveCategories()
    {
        return $this->categoryRepository->getActive();
    }

    public function findCategory($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function searchCategories($search)
    {
        return $this->categoryRepository->search($search);
    }

    /**
     * ✅ CREATE
     */
    public function createCategory(CategoryFormRequest $request)
    {
        // Generate slug automatically
        $request->merge([
            'slug' => Str::slug($request->validated('name'))
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $request->merge([
                'image' => $this->handleImageUpload($request->file('image'))
            ]);
        }

        // Build DTO from request
        $dto = CategoryDto::formData($request);

        return $this->categoryRepository->create($dto->toArray());
    }

    /**
     * ✅ UPDATE
     */
    public function updateCategory($id, CategoryFormRequest $request)
    {
        $category = $this->categoryRepository->find($id);

        $request->merge([
            'slug' => Str::slug($request->validated('name'))
        ]);

        // Handle image replacement
        if ($request->hasFile('image')) {
            if ($category->image) {
                $this->deleteImage($category->image);
            }

            $request->merge([
                'image' => $this->handleImageUpload($request->file('image'))
            ]);
        }

        $dto = CategoryDto::formData($request);

        return $this->categoryRepository->update($id, $dto->toArray());
    }

    /**
     * ✅ DELETE
     */
    public function deleteCategory($id)
    {
        $category = $this->categoryRepository->find($id);

        if ($category->products()->count() > 0) {
            throw new Exception(
                'Cannot delete category with existing products. Please reassign or delete products first.'
            );
        }

        if ($category->image) {
            $this->deleteImage($category->image);
        }

        return $this->categoryRepository->delete($id);
    }

    public function toggleCategoryStatus($id)
    {
        $category = $this->categoryRepository->find($id);

        return $this->categoryRepository->update($id, [
            'is_active' => ! $category->is_active,
        ]);
    }

    protected function handleImageUpload($image)
    {
        return $image->store('categories', 'public');
    }

    protected function deleteImage($imagePath)
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    public function getCategoryStatistics()
    {
        $categories = $this->categoryRepository->all();

        return [
            'total_categories' => $categories->count(),
            'active_categories' => $categories->where('is_active', true)->count(),
            'inactive_categories' => $categories->where('is_active', false)->count(),
            'categories_with_products' => $categories
                ->filter(fn ($category) => $category->products()->count() > 0)
                ->count(),
        ];
    }
}