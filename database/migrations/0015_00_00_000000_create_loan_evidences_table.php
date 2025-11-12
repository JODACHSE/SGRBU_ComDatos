<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Illuminate\Support\enum_value;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_evidences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_resource_id')->constrained('loan_resources');
            $table->enum('loan_type', ['prestamo', 'devuelución'])->default('prestamo');
            $table->string('photo_path');
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_evidences');
    }
};