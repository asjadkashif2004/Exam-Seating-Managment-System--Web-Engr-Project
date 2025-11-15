<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // rename `number` -> `room_no`
            if (Schema::hasColumn('rooms', 'number')) {
                $table->renameColumn('number', 'room_no');
            }
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'room_no')) {
                $table->renameColumn('room_no', 'number');
            }
        });
    }
};
