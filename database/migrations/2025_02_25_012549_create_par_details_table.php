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
        Schema::create('par_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('par_header_id')->nullable(false);
            $table->unsignedBigInteger('item_id')->nullable(false);
            $table->string('sku', 100)->nullable(false);
            $table->string('barcode', 100)->nullable(false);
            $table->string('item_description')->nullable(false);
            $table->decimal('price', 16, 2)->nullable()->default(0.00);
            $table->decimal('quantity', 16, 0)->nullable()->default(0);
            $table->string('transfer_type')->nullable();
            $table->string('transfer_specification')->nullable();
            $table->string('status')->default('OPEN');
            $table->date('date_received')->nullable();
            $table->unsignedBigInteger('transferred_to')->nullable();
            $table->date('date_transferred')->nullable();
            $table->longText('par_attachment')->nullable();
            $table->longText('ptr_attachment')->nullable();
            $table->longText('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('par_details');
    }
};
