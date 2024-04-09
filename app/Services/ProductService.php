<?php

namespace App\Services;

use App\Constants\Constant;
use App\Helpers\ImageHelper;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function createProduct($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->input();
            if ($request->hasFile('image')) {
                $fileName = ImageHelper::saveImage($request->file('image') ,Constant::PATH_PRODUCT);
            }
            $dataInsert = [
                'name' => $data['name'],
                'image' => $fileName ?? null,
                'category_id' => $data['category_id'] ,
                'price' => $data['price'],
                'description' => $data['description'] ?? null
            ];
            $this->productRepository->create($dataInsert);
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }
    }

    public function updateProduct($request, $id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->findOrFail($id);

            if($product) {
                $data = $request->input();
                $dataUpdate = [
                    'name' => $data['name'],
                    'category_id' => $data['category_id'] ,
                    'price' => $data['price'] ,
                    'description' => $data['description'] ?? null,
                ];
                if ($request->hasFile('image')) {
                    $fileName = ImageHelper::saveImage($request->file('image') ,Constant::PATH_PRODUCT);

                    $dataUpdate['image'] = $fileName;
                    ImageHelper::deleteImage($product->image, Constant::PATH_PRODUCT);
                }

                $product->update($dataUpdate);
            }
            DB::commit();

            return true;

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }
    }



    public function deleteProduct($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->findOrFail($id);

            if($product){
                ImageHelper::deleteImage($product->image,Constant::PATH_PRODUCT);

                $this->productRepository->deleteById($id);
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
