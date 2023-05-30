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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_code');
            $table->foreignId('purchase_id')
                    ->constrained('purchases', 'id')
                    ->onUpdate('cascade');
            $table->foreignId('supplier_id')
                    ->constrained('suppliers', 'id')
                    ->onUpdate('cascade');
            $table->foreignId('product_id')
                    ->constrained('products', 'id')
                    ->onUpdate('cascade');
            $table->string('product_name');
            $table->decimal('cost', 10,2)->default(0);
            $table->integer('quantity')->default(0);
            $table->foreignId('unit_id')
                    ->constrained('units', 'id')
                    ->onUpdate('cascade');
            $table->decimal('discount', 10,2)->default(0);
            $table->decimal('amount', 10,2)->default(0);            
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};