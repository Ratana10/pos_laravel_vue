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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name');
            $table->foreignId('category_id')
                    ->constrained('categories','id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('unit_id')
                    ->constrained('units','id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->decimal('price',10,2)->default(0);
            $table->decimal('cost',10,2)->default(0);
            $table->decimal('discount',10,2)->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('alert')->default(0);
            $table->longText('image')->nullable();
            $table->string('barcode')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};