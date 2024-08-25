<?php

namespace App\Resources\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => [
                "id" => $this->id,
                "phone" => $this->phone,
                "email" => $this->email,
                "name" => $this->name,
                "created_at" => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
                'roles' => $this->roles,
            ],
            'message' => 'ok'
        ];
    }
}
