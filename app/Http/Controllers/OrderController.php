<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IOrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller {
    private IOrderRepository $orderRepository;

    /**
     * OrderController constructor.
     * @param IOrderRepository $orderRepository
     */
    public function  __construct(IOrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function index() {

    }

    public function show(int $id) {

    }

    public function store(Request $request) {

    }
}
