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
}
