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
        Schema::create('par_borrowed_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('par_detail_id')->nullable(false);
            $table->unsignedBigInteger('item_id')->nullable(false);
            $table->string('sku', 100)->nullable(false);
            $table->string('barcode', 100)->nullable(false);
            $table->string('item_description')->nullable(false);
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->date('date_borrowed')->nullable();
            $table->date('date_returned')->nullable();
            $table->string('status')->default('OPEN');
            $table->longText('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('par_borrowed_items');
    }
};
