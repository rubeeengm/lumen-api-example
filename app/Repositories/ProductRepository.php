<?php

namespace App\Repositories;

use App\Dtos\Products\ProductCreateDto;
use App\Dtos\Products\ProductUpdateDto;
use App\Models\Product;
use App\Repositories\Interfaces\IProductRepository;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProductRepository implements IProductRepository {

    /**
     * @inheritDoc
     */
    public function paginate(int $take) : Paginator {
        return Product::orderBy('name')
//            ->where('price','>=','80')
//            ->where('price','<=','100')
                ->whereBetween('price',[80,100])
                ->simplePaginate($take);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id) : ?Product {
        return Product::find($id);
    }

    /**
     * @inheritDoc
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
     * @inheritDoc
     */
    public function update(ProductUpdateDto $store) : void {
        $entry = Product::find($store->id);

        $entry->sku = $store->sku;
        $entry->name = $store->name;
        $entry->description = $store->description;
        $entry->price = $store->price;

        $entry->save();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function image(int $id, UploadedFile $file): void {
        $entry = Product::find($id);

        if (!$entry) {
            throw new Exception("Entry wasn't found by " . $id);
        }

        //filename
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        //path
        $path = app()->basePath('public/images/');

        //upload
        $file->move($path, $filename);

        $entry->image = URL::to('images/' . $filename);

        //save changes
        $entry->save();
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id) : void {
        Product::destroy($id);
    }
}
