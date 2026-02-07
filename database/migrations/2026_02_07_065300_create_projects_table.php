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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->dateTime('inquiry_date')->nullable();
            $table->dateTime('target_date')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('total_hours')->nullable();
            $table->string('par_day_hours')->nullable();
            $table->string('assigned_user')->nullable();
            $table->enum('status', ['InPlanning', 'Running', 'Stopped', 'Completed'])->default('InPlanning');
            $table->foreignId('created_id')->constrained('users');
            $table->foreignId('updated_id')->nullable()->constrained('users');
            $table->foreignId('deleted_id')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
