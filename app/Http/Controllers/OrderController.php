<?php

namespace App\Http\Controllers;

use App\Dtos\Orders\OrderCreateDto;
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

    /**
     * @return \Illuminate\Pagination\Paginator|null
     */
    public function index() {
        return $this->orderRepository->paginate(20);
    }

    /**
     * @param int $id
     * @return \App\Models\Order|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function show(int $id) {
        $result = $this->orderRepository->find($id);

        if ($result) {
            return $result;
        }

        return response('Order not found', 404);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function items(int $id) {
        $result = $this->orderRepository->find($id);

        if ($result) {
            return $result->items()->paginate(1);
        }

        return response('Order not found', 404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id'
            , 'items.*.quantity' => 'required|numeric|min:1'
            , 'items.*.product_id' => 'required|exists:products,id'
            , 'items.*.unit_price' => 'required|numeric|min:1'
        ]);

        $store = new OrderCreateDto($request->all());
        $result = $this->orderRepository->store($store);

        return response()->json($result, 201);
    }
}
