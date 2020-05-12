<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IProductRepository;

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
}
