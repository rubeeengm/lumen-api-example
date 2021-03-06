<?php

namespace App\Repositories\Interfaces;

use App\Dtos\Products\ProductCreateDto;
use App\Dtos\Products\ProductUpdateDto;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\Paginator;

interface IProductRepository {
    /**
     * @param int $take
     * @return Paginator
     */
    public function paginate(int $take) : Paginator;

    /**
     * @param int $id
     * @return Product|null
     */
    public function find(int $id) : ?Product;

    /**
     * @param ProductCreateDto $store
     * @return Product
     */
    public function store(ProductCreateDto $store) : Product;

    /**
     * @param ProductUpdateDto $store
     */
    public function update(ProductUpdateDto $store) : void;

    /**
     * @param int $id
     * @param UploadedFile $file
     */
    public function image(int $id, UploadedFile $file) : void;

    /**
     * @param int $id
     */
    public function destroy(int $id) : void;
}
