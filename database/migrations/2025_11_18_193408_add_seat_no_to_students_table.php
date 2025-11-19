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
       
    Schema::table('students', function (Blueprint $table) {
        $table->integer('seat_no')->nullable()->after('room_id');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        

    Schema::table('students', function (Blueprint $table) {
        $table->dropColumn('seat_no');
    });

    }
};
