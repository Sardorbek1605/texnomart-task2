<?php

namespace App\Repositories;

use App\Filters\OrderFilter;
use App\Filters\UserFilter;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\LogisticCompany;
use App\Models\Order;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    public function calculateOrderPrice(Request $request)
    {
        $products_price = Product::whereIn('id', $request->products)->select(DB::raw('sum(cost) as total_price'))->first();
        $delivery_price = LogisticCompany::where('id', $request->logistic_company_id)->select('delivery_cost')->first();
        return [
            'products_price' => (int)$products_price->total_price,
            'delivery_price' => (int)$delivery_price->delivery_cost
        ];
    }

    public function createOrder(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'logistic_company_id' => $request->logistic_company_id,
            'payment_id' => $request->payment_id,
            'status_id' => Status::where('key', 'new')->first()->id,
            'description' => $request->description
        ]);
        $order->products()->attach($request->products);
        return $order;
    }

    public function getAllOrders(Request $request)
    {
        $orders = new OrderFilter(Order::class, $request->all());
        return $orders->filter()->paginate(10);
    }

    public function changeStatusOrder($order_id, Request $request)
    {
        // TODO: Implement changeStatusOrder() method.
    }

    public function deleteOrder($order_id)
    {
        // TODO: Implement deleteOrder() method.
    }
}
