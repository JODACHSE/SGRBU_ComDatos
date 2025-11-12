<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('contact_type_id')->constrained('contact_types');
            $table->string('contact_value');
            $table->boolean('is_principal')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['user_id', 'contact_type_id', 'contact_value']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
