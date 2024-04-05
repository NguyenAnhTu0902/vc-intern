<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProduct($data, $select = '*')
    {
        $products = $this->productRepository->list($data, $select);
        return [
            'products' => $products,
            'itemStart' => $products->firstItem(),
        ];

    }
}
