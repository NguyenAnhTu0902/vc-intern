<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    protected $productRepository;

    public function __construct(ProductService $productService, ProductRepository $productRepository)
    {
        $this->productService = $productService;
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $result = $this->productService->listProduct($data);
        return view('elements.product.index', compact('result'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('elements.product.add', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $this->productService->createProduct($request);
        return redirect()->route('product.index')->with('alert', 'Thêm mới thành công!');
    }

    public function detail($id)
    {
        $product = $this->productRepository->findOrFail($id);
        $categories = Category::all();
        return view('elements.product.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $this->productService->updateProduct($request, $id);
        return $this->productService->updateProduct($request, $id) ?
            redirect()->route('product.index')->with('alert', 'Cập nhật thành công!'):
            redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }

    public function delete($id)
    {
        return $this->productService->deleteProduct($id) ?
                redirect()->route('product.index')->with('alert', 'Xóa thành công!') :
                redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }
}
