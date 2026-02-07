<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Basic Product Info
            $table->string('serial_no')->unique();
            $table->string('requiredment_type')->nullable();
            $table->string('project_code')->nullable();
            $table->string('pcb_code')->nullable();

            // Specification
            $table->string('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->string('layer')->nullable();
            $table->string('pcb_thickness')->nullable();

            // SKU / MPN
            $table->string('sku')->nullable();
            $table->string('mpn')->nullable();

            // Vendor & Links
            $table->string('suggested_vendor')->nullable();
            $table->string('order_vendor')->nullable();
            $table->string('vendor')->nullable();
            $table->text('gerber_link')->nullable();

            // Purchase / Order / Receive
            $table->string('order_qty')->nullable();
            $table->string('receive_qty')->nullable();
            $table->string('price_per_piece', 10, 2)->nullable();

            // Dates
            $table->date('order_date')->nullable();
            $table->date('expected_date')->nullable();
            $table->date('target_receive_date')->nullable();
            $table->date('receive_date')->nullable();

            // Persons
            $table->string('request_person')->nullable();
            $table->string('order_person')->nullable();
            $table->string('receiver_name')->nullable();

            // Status
            $table->enum('status', [
                'InPurchase',
                'Ordered',
                'Received',
            ])->default('InPurchase');

            // image
            $table->string('image')->nullable();
            $table->foreignId('created_id')->constrained('users');
            $table->foreignId('updated_id')->nullable()->constrained('users');
            $table->foreignId('deleted_id')->nullable()->constrained('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
