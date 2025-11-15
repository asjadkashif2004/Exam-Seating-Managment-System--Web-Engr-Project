<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_number_to_rooms_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->unsignedInteger('number')->nullable()->after('name');
            $table->index('number');
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropIndex(['number']);
            $table->dropColumn('number');
        });
    }
};
