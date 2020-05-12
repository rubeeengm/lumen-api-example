<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;
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

    public function store($store);

    public function update($store);

    public function destroy(int $id);
}
