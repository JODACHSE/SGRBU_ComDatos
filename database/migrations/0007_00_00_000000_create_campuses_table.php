<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campuses', function (Blueprint $table) {
            $table->id();
            $table->enum('campus_type', ['Principal', 'Seccional', 'Extensión', 'Oficinas'])->default('Extensión');
            $table->string('department')->default('Cundinamarca');
            $table->string('municipality');
            $table->string('address');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['campus_type', 'department', 'municipality', 'address']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campus');
    }
};
