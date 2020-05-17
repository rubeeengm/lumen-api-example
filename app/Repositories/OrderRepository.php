<?php

namespace App\Repositories;

use App\Dtos\Orders\OrderCreateDto;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Interfaces\IOrderRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class OrderRepository implements IOrderRepository {

    /**
     * @inheritDoc
     */
    public function paginate(int $take)  : ?Paginator {
        return Order::simplePaginate($take);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id) : ?Order {
        return Order::find($id);
    }

    /**
     * @inheritDoc
     */
    public function store(OrderCreateDto $store) : Order {
        $entry = new Order();
        $entry->customer_id = $store->customer_id;

        //total
        $this->setTotal($entry, $store->items);

        //item
        $this->setItem($store);

        //save
        DB::transaction(function () use ($entry, $store) {
            $entry->save();
            $entry->items()->saveMany($store->items);
        });

        return $entry;
    }

    /**
     * @param Order $order
     * @param array $items
     */
    private function setTotal(Order &$order, array $items) : void {
        foreach ($items as $item) {
            //total header
            $order->total += $item['quantity'] * $item['unit_price'];
        }
    }

    /**
     * @param OrderCreateDto $store
     */
    private function setItem(OrderCreateDto &$store) : void {
        $detail = [];

        foreach ($store->items as $item) {
            $order_detail = new OrderDetail();
            $order_detail->quantity = $item['quantity'];
            $order_detail->product_id = $item['product_id'];
            $order_detail->unit_price = $item['unit_price'];
            $order_detail->total = $item['unit_price'] * $item['quantity'];

            $detail[] = $order_detail;
        }

        $store->items = $detail;
    }
}
