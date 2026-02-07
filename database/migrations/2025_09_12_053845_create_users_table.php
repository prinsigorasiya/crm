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
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 60);
            $table->string('middle_name', 60)->nullable();
            $table->string('last_name', 60);
            $table->string('user_name')->nullable();
            $table->longText('email')->nullable();
            $table->string('department')->nullable();
            $table->string('role')->nullable();
            $table->text('password');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->foreignId('created_id')->constrained('users');
            $table->foreignId('updated_id')->nullable()->constrained('users');
            $table->foreignId('deleted_id')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
