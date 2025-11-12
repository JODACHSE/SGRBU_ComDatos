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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('second_name')->nullable();
            $table->string('lastname');
            $table->string('second_lastname')->nullable();

            $table->foreignId('document_type_id')->nullable()->constrained('document_types');
            $table->string('identification_number')->unique();

            $table->foreignId('gender_id')->nullable()->constrained('genders');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');

            $table->enum('role', ['admin', 'staff', 'profesor', 'estudiante'])->default('estudiante');
            $table->foreignId('campus_program_id')->nullable()->constrained('campus_program');
            $table->enum('academic_status', ['activo', 'baja temporal', 'baja permanente', 'condicional', 'egresado'])->default('activo');
            $table->string('student_code')->nullable()->unique();
            $table->boolean('is_active')->default(true);

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
