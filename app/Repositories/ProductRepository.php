<?php

namespace App\Repositories;

use App\Dtos\Products\ProductCreateDto;
use App\Dtos\Products\ProductUpdateDto;
use App\Models\Product;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Pagination\Paginator;

class ProductRepository implements IProductRepository {

    /**
     * @param int $take
     * @return Paginator
     */
    public function paginate(int $take) : Paginator {
        return Product::orderBy('name')
//            ->where('price','>=','80')
//            ->where('price','<=','100')
                ->whereBetween('price',[80,100])
                ->simplePaginate($take);
    }

    /**
     * @param int $id
     * @return Product|null
     */
    public function find(int $id) : ?Product {
        return Product::find($id);
    }

    /**
     * @param ProductCreateDto $store
     * @return Product
     */
    public function store(ProductCreateDto $store) : Product {
        $entry = new Product();

        $entry->sku = $store->sku;
        $entry->name = $store->name;
        $entry->description = $store->description;
        $entry->price = $store->price;

        $entry->save();

        return $entry;
    }

    /**
     * @param ProductUpdateDto $store
     */
    public function update(ProductUpdateDto $store) {
        // TODO: Implement update() method.
    }

    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
    }
}
