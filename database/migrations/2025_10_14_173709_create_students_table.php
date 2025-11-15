<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cmd_id', 50)->unique();           // roll/CMD
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->string('semester', 50);
            $table->foreignId('room_id')->nullable()->constrained()->nullOnDelete();
            $table->string('invigilator')->nullable();
            $table->timestamps();

            $table->index(['department_id', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
