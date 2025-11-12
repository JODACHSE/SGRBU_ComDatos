<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('campus_id')->constrained('campuses');
            $table->datetime('loan_date');
            $table->datetime('expected_return_date');
            $table->datetime('actual_return_date')->nullable();
            $table->enum('loan_status', ['pendiente', 'aprovado', 'activo', 'completado', 'vencido', 'cancelado'])->default('pendiente');
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
