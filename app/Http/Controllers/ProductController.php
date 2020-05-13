<?php

namespace App\Http\Controllers;

use App\Dtos\Products\ProductCreateDto;
use App\Dtos\Products\ProductUpdateDto;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller {
    private IProductRepository $productRepository;

    /**
     * ProductController constructor.
     * @param IProductRepository $productRepository
     */
    public function __construct(IProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    /**
     * @return \Illuminate\Pagination\Paginator
     */
    public function index() {
        return $this->productRepository->paginate(20);
    }

    /**
     * @param int $id
     * @return \App\Models\Product|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function show(int $id) {
        $result = $this->productRepository->find($id);

        if (!$result) {
            return response('Product not found', 404);
        }

        return $result;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function store(Request $request) {
        //validation
        $this->validate($request, [
           'sku' => 'required|unique:products'
           , 'name' => 'required'
           , 'description' => 'required'
           , 'price' => 'required|numeric|min:1'
        ]);

        //mapping
        $store = new ProductCreateDto($request->all());

        //creation
        $result = $this->productRepository->store($store);

        return response($result,201);
    }

    public function update(int $id, Request $request) {
        $data = $request->all();
        $data['id'] = $id;
        $store = new ProductUpdateDto($data);

        return response()->json($store);
    }
}
