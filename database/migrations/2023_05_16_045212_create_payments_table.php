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
            $table->date('date');
            $table->foreignId('sale_id')
                    ->constrained('sales', 'id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->decimal('due_amount', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('change', 10, 2)->default(0);
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('remain', 10, 2)->default(0);
            $table->integer('pay_by')->default(1);
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
        Schema::dropIfExists('payments');
    }
};