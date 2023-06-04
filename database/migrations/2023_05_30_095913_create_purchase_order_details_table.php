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
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->primary(['purchase_order_id','product_id']);
            $table->foreignId('purchase_order_id')
                    ->constrained('purchases_order', 'id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('product_id')
                    ->constrained('products', 'id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('product_name');
            $table->decimal('cost', 10,2)->default(0);
            $table->integer('quantity')->default(1);
            $table->foreignId('unit_id')
                    ->constrained('units', 'id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->decimal('discount', 10,2)->default(0);
            $table->decimal('amount', 10,2)->default(0);            
            $table->tinyInteger('status')->default(2);            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
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