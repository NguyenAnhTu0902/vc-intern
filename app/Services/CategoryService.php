<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function listCategory($data, $select = '*')
    {
        $categories = $this->categoryRepository->list($data, $select);
        return [
            'categories' => $categories,
            'itemStart' => $categories->firstItem(),
        ];

    }

    public function storeCategory($request)
    {
        DB::beginTransaction();
        try {
            $this->categoryRepository->create($request->only('name'));
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }
    }

    public function updateCategory($request, $id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->findOrFail($id);
            if($category) {
                $category->update($request->only('name'));
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }
    }

    public function deleteCategory($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->findOrFail($id);
            if($category){
                $this->categoryRepository->deleteById($id);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }

    }
}
