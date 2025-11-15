<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       
        Schema::create('rooms', function (Blueprint $table) {
    $table->id();
    $table->foreignId('department_id')->constrained()->cascadeOnDelete();
    $table->string('room_no');                // <-- this is the key bit
    $table->unsignedInteger('capacity');
    $table->string('invigilator')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
