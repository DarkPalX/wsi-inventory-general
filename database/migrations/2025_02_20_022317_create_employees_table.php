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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('emp_id')->nullable(false);
            $table->date('hired_date')->nullable();
            $table->text('avatar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
