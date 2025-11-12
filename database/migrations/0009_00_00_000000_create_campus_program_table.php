<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campus_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campus_id')->constrained('campuses');
            $table->foreignId('program_id')->constrained('programs');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['campus_id', 'program_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campus_program');
    }
};
