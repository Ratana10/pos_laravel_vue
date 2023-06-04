<?php

use App\Enums\SaleStatus;
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
            $table->date('date');
            $table->string('code');
            $table->foreignId('customer_id')
                    ->constrained('customers', 'id')
                     ->onDelete('cascade')
                     ->onUpdate('cascade');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->tinyInteger('payment_status')->comment('1=paid,2=unpaid,3=partial')->default(2);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('sales');
    }
};