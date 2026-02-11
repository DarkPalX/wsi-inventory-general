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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique()->nullable(false);
            $table->string('barcode', 100)->unique();
            $table->string('name')->nullable(false);
            $table->string('slug')->nullable(false);
            // $table->string('supplier_id')->nullable();
            // $table->string('location')->nullable(true);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('unit_id')->default(1);
            $table->unsignedBigInteger('type_id')->default(1);
            $table->text('image_cover')->nullable();
            // $table->decimal('price', 16, 2)->nullable()->default(0.00);
            $table->integer('minimum_stock')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
