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
            $table->string('user_id') -> nullable();
            $table->string('title') -> nullable();
            $table->string('address') -> nullable();
            $table->string('image') -> nullable();
            $table->string('initial_price') -> nullable();
            $table->string('current_price') -> nullable();
            $table->string('guest_minimun') -> nullable();
            $table->string('guest_max') -> nullable();
            $table->string('bedroom_count') -> nullable();
            $table->string('bathroom_count') -> nullable();
            $table->string('additionals') -> nullable();
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
