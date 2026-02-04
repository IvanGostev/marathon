<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mutual_aid_requests', function (Blueprint $table) {
            $table->dropColumn('file_path');
            $table->json('file_paths')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mutual_aid_requests', function (Blueprint $table) {
            //
        });
    }
};
