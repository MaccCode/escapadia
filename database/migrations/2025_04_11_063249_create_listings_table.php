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
    Schema::create('listings', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('user_id')->nullable();

        $table->string('title')->nullable();
        $table->string('property_type')->nullable();

        $table->text('address')->nullable();
        $table->text('description')->nullable();
        $table->text('map_link')->nullable();

        $table->string('image')->nullable();

        $table->decimal('initial_price', 10, 2)->nullable();
        $table->decimal('current_price', 10, 2)->nullable();

        $table->integer('guest_minimum')->nullable();
        $table->integer('guest_max')->nullable();

        $table->integer('bedroom_count')->nullable();
        $table->integer('bathroom_count')->nullable();

        $table->json('rooms')->nullable();
        $table->decimal('room_total_price', 10, 2)->nullable();

        $table->json('additionals')->nullable();

        $table->decimal('commission_amount', 10, 2)->nullable();
        $table->decimal('payable_amount', 10, 2)->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
