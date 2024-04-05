<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $categoryRepository;

    public function __construct(CategoryService $categoryService, CategoryRepository $categoryRepository)
    {
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $result = $this->categoryService->listCategory($data);
        return view('elements.category.index', compact('result'));
    }

    public function create()
    {
        return view('elements.category.add');
    }

    public function store(Request $request)
    {
        $this->categoryService->storeCategory($request);
        return redirect()->route('category.index')->with('alert', 'Thêm mới thành công!');
    }

    public function detail($id)
    {
        $category = $this->categoryRepository->findOrFail($id);
        return view('elements.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->categoryService->updateCategory($request, $id);
        return redirect()->route('category.index')->with('alert', 'Cập nhật thành công!');
    }

    public function delete($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('category.index')->with('alert', 'Xóa thành công!');
    }
}
