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
        Schema::create('purchases_order', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->date('date');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->foreignId('supplier_id')
                    ->constrained('suppliers', 'id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->tinyInteger('payment_status')->default(2);
            $table->tinyInteger('status')->default(2);
            $table->foreignId('created_by')
                    ->constrained('users', 'id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases_order');
    }
};