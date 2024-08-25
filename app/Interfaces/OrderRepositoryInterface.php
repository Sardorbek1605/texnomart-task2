<?php

namespace App\Interfaces;


use Illuminate\Http\Request;

interface OrderRepositoryInterface
{
    public function calculateOrderPrice(Request $request);
    public function createOrder(Request $request);
    public function getAllOrders(Request $request);
    public function changeStatusOrder($order_id, Request $request);
    public function deleteOrder($order_id);
}
