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
            $table->string('user_id') -> nullable();
            $table->string('lister_id') -> nullable();
            $table->string('name') -> nullable();
            $table->string('phone') -> nullable();
            $table->string('start_date') -> nullable();
            $table->string('end_date') -> nullable();
            $table->string('price') -> nullable();
            $table->string('payment_status') -> nullable();
            $table->string('status') -> nullable();
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
