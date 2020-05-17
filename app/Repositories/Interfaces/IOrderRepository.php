<?php

namespace App\Repositories\Interfaces;

use App\Dtos\Orders\OrderCreateDto;
use App\Models\Order;
use Illuminate\Pagination\Paginator;

interface IOrderRepository {
    /**
     * @param int $take
     * @return Paginator|null
     */
    public function paginate(int $take) : ?Paginator;

    /**
     * @param int $id
     * @return Order|null
     */
    public function find(int $id) : ?Order;

    /**
     * @param OrderCreateDto $store
     * @return Order|null
     */
    public function store(OrderCreateDto $store) : ?Order;
}
