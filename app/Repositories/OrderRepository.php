<?php

namespace App\Repositories;

use App\Dtos\Orders\OrderCreateDto;
use App\Models\Order;
use App\Repositories\Interfaces\IOrderRepository;
use Illuminate\Pagination\Paginator;

class OrderRepository implements IOrderRepository {

    /**
     * @param int $take
     * @return Paginator|null
     */
    public function paginate(int $take): ?Paginator {
        return null;
    }

    /**
     * @param int $id
     * @return Order|null
     */
    public function find(int $id): ?Order {
        return null;
    }

    /**
     * @param OrderCreateDto $store
     * @return Order|null
     */
    public function store(OrderCreateDto $store): ?Order {
        return null;
    }
}
