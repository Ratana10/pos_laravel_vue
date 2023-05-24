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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                    ->constrained('customers', 'id')
                     ->onUpdate('cascade');
            $table->decimal('total', 10, 2)->default(0.00);
            $table->unsignedInteger('status')->comment('1=paid,2=unpaid,3=partially_paid')->default(2);
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
        Schema::dropIfExists('sales');
    }
};