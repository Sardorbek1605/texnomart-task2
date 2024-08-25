<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('logistic_company_id')->nullable()->references('id')->on('logistic_companies')->onDelete('set null');
            $table->foreignId('payment_id')->nullable()->references('id')->on('payments')->onDelete('set null');
            $table->foreignId('status_id')->nullable()->references('id')->on('statuses')->onDelete('set null');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('total_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
