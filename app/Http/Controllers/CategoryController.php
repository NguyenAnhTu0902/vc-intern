<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
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

    public function store(CategoryRequest $request)
    {
        return $this->categoryService->storeCategory($request) ?
                redirect()->route('category.index')->with('alert', 'Thêm mới thành công!'):
                redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }

    public function detail($id)
    {
        $category = $this->categoryRepository->findOrFail($id);
        return view('elements.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        return $this->categoryService->updateCategory($request, $id)?
                redirect()->route('category.index')->with('alert', 'Cập nhật thành công!') :
                redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }

    public function delete($id)
    {
        return $this->categoryService->deleteCategory($id)?
            redirect()->route('category.index')->with('alert', 'Xóa thành công!') :
            redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }
}
