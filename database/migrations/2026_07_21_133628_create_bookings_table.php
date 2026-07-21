<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('lister_id')->nullable();
            $table->unsignedBigInteger('property_id');

            $table->string('name')->nullable();
            $table->unsignedBigInteger('phone');
            $table->string('email')->nullable();

            $table->date('start_date');
            $table->date('end_date');

            $table->integer('number_of_guests');

            $table->string('status')->default('pending');

            $table->integer('price')->nullable();
            $table->mediumText('commission_amount')->nullable();
            $table->mediumText('payable_amount')->nullable();

            $table->string('payment_status')->default('unpaid');
            $table->string('payment_method')->nullable();

            $table->string('message')->nullable();
            $table->string('stay_status')->nullable();

            $table->string('transaction_id')->nullable();

            $table->timestamps();

            // Optional foreign keys
            // $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            // $table->foreign('property_id')->references('id')->on('properties')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};