<?php

namespace App\Http\Controllers;

use App\Dtos\Products\ProductCreateDto;
use App\Dtos\Products\ProductUpdateDto;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * @throws \Illuminate\Validation\ValidationException
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

    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(int $id, Request $request) {
        //validation
        $this->validate($request, [
            'sku' => [
                'required'
                , Rule::unique('products')->ignore($id)
            ]
            , 'name' => 'required'
            , 'description' => 'required'
            , 'price' => 'required|numeric|min:1'
        ]);

        //mapping
        $data = $request->all();
        $data['id'] = $id;
        $entry = new ProductUpdateDto($data);

        //updating
        $this->productRepository->update($entry);

        return response(null,204);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function image(int $id, Request $request) {
        //validation
        $this->validate($request, [
            'image' => 'mimes:jpeg, png, bmp, tiff'
        ]);

        $this->productRepository->image(
            $id, $request->file('image')
        );

        return response(null, 204);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function destroy(int $id) {
        $this->productRepository->destroy($id);

        return response(null, 204);
    }
}
