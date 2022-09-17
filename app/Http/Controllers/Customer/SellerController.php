<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ListProductsRequest;
use App\Http\Resources\SellerProfileResource;
use App\Models\SellerProfile;
use App\Services\SellerService;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    protected $seller_service;
    public function __construct(SellerService $seller_service)
    {
        $this->seller_service=$seller_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ListProductsRequest $request)
    {
        $data=$request->validated();
        $seller_profiles=$this->seller_service->listWithProducts($data['address_uuid']);
        return SellerProfileResource::collection($seller_profiles);
    }
}
