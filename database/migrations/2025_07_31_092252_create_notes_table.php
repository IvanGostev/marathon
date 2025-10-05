<?php

use App\Models\Book;
use App\Models\User;
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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Book::class)->nullable();
            $table->foreignIdFor(User::class);
            $table->string('mybook')->nullable();
            $table->string('title')->nullable();
            $table->string('status');
            $table->text('text');
            $table->text('results')->nullable();
            $table->text('go')->nullable();
            $table->bigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
