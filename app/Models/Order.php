<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logistic_company_id',
        'payment_id',
        'status_id',
        'description',
    ];

    public $timestamps = [
        'created_at',
        'updated_at'
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'products_orders', 'order_id', 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function logistic_company(){
        return $this->belongsTo(LogisticCompany::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
