<?php

namespace App\Resources\Order;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function($item) {
                return [
                    "id" => $item->id,
                    "user" => $item->user,
                    "logistic_company" => $item->logistic_company,
                    "payment" => $item->payment,
                    "status" => $item->status,
                    "created_at" => Carbon::parse($item->created_at)->format('Y-m-d H:i:s'),
                    "updated_at" => Carbon::parse($item->updated_at)->format('Y-m-d H:i:s'),
                    'products' => $item->products,
                ];
            }),
            'message' => 'ok'
        ];
    }
}
