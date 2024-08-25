<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderRepositoryInterface;
use App\Resources\Order\OrderCollection;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $repostory;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function calculateOrderPrice(Request $request){
        $total_price = $this->repository->calculateOrderPrice($request);
        return response()->successJson($total_price);
    }

    public function create(Request $request)
    {
        $order = $this->repository->createOrder($request);
        return response()->successJson($order);
    }

    public function cancel()
    {

    }

    public function orders(Request $request)
    {
        return new OrderCollection($this->repository->getAllOrders($request));
    }

    public function changeStatus()
    {

    }

    public function delete()
    {

    }
}
