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
        Schema::create('requisition_headers', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->nullable();
            $table->string('entity_name')->nullable();
            $table->string('fund_cluster')->nullable();
            $table->string('section_id')->nullable(false);
            $table->string('responsibility_center_code')->nullable();
            $table->date('date_requested');
            $table->date('date_needed');
            $table->longText('purpose')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('status')->default('SAVED');
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->timestamp('requested_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('posted_by')->nullable();
            $table->timestamp('posted_at')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisition_headers');
    }
};
