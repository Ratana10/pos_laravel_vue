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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')
                    ->constrained('sales', 'id')
                    ->onUpdate('cascade');
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->decimal('change', 10, 2)->default(0);
            $table->unsignedInteger('payment_method')->comment('1=cash,2=aba')->default(1);
            $table->foreignId('created_by')
                    ->constrained('users', 'id')
                    ->onUpdate('cascade');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};