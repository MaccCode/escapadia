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
    Schema::create('completes', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('user_id')->nullable();
        $table->unsignedBigInteger('lister_id')->nullable();
        $table->unsignedBigInteger('property_id')->nullable();

        $table->string('name')->nullable();
        $table->string('phone')->nullable();
        $table->string('email')->nullable();

        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();

        $table->decimal('price', 10, 2)->nullable();
        $table->decimal('commission_amount', 10, 2)->nullable();
        $table->decimal('payable_amount', 10, 2)->nullable();

        $table->string('payment_status')->nullable();
        $table->string('status')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completes');
    }
};
