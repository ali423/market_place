<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{

    protected $repository;
    protected $upload_service;
    public function __construct(ProductRepository $repository,UploadService $upload_service)
    {
        $this->repository=$repository;
        $this->upload_service=$upload_service;
    }
    public function create($data)
    {
     $seller=auth()->user();
     $image_path=$this->upload_service->upload($data['image'],'seller/product/image');
     $data['image']=$image_path;
     $this->repository->createProduct($seller,$data);
    }

    public function listWithPagination(){
        $seller=auth()->user();
        return $this->repository->sellerProductsWithPagination($seller);
    }

    public function update(Product $product,$data)
    {
        if (isset($data['image'])){
            $image_path=$this->upload_service->upload($data['image'],'seller/product/image');
            $data['image']=$image_path;
        }
        $this->repository->update($product,$data);
    }
    public function delete(Product $product){
        $this->repository->delete($product);
    }
}
