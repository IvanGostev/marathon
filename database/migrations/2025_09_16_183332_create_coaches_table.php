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
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('coach'); // coach/partner
            $table->string('status')->default('waiting');
            $table->unsignedBigInteger('leader')->index();
            $table->unsignedBigInteger('venerable')->index();
            $table->foreign('leader')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('venerable')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
