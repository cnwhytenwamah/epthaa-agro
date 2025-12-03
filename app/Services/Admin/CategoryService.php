<?php

namespace App\Services\Admin;

use stdClass;
use App\Dto\CategoryDto;
use App\Http\Requests\CategoryFormRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Repositories\Interfaces\CategoryRepositoryInterface;


class CategoryService extends AdminBaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ){}

    public function create(CategoryFormRequest $request):stdClass
    {
        try{
            $categoryDto = CategoryDto::formData($request);
            $response = $this->categoryRepository->create($categoryDto->toArray());
            if(!$response){
                return $this->errorMsg("An error error occurred while processing your request, please try again", 422);
            }
            return $this->successMsg("Category created successfully");
        }catch(HttpException $e){
            return $this->errorMsg($e->getMessage(), $e->getStatusCode());
        } 

        return $this->successMsg("created successfully");
    }

    public function update(CategoryFormRequest $request):stdClass
    {
        $validated = $request->validated();
        $blog = $this->categoryRepository->singleCategory($validated['id']);
        if($blog){
            try{
                $categoryDto = CategoryDto::formData($request);
                $response = $this->categoryRepository->update($categoryDto->toArray(), $blog);
                if(!$response){
                    return $this->errorMsg("An error error occurred while processing your request, please try again", 422);
                }
                return $this->successMsg("Category updated successfully");
            }catch(HttpException $e){
                return $this->errorMsg($e->getMessage(), $e->getStatusCode());
            } 
        }
        
        return $this->errorMsg("Invalid category ID", 422);
    }

    public function list():stdClass
    {
        $categories = $this->categoryRepository->listCategories();
        return $this->successMsg("retrieved successfully", $categories);
    }
    public function singleCategory(int $id):?stdClass
    {
        $response = $this->categoryRepository->singleCategory($id);
        return $this->successMsg("retrieved successfully", $response);
    }
}
