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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('ID_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
