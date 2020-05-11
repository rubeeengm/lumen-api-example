<?php

namespace App\Repositories\Interfaces;

interface IProductRepository {
    public function paginate();

    public function find(int $id);

    public function store($store);

    public function update($store);

    public function destroy(int $id);
}
