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
        Schema::create('customer_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name', 150);
            $table->integer('customer_id');
            $table->string('spheris_right', 10);
            $table->string('spheris_left', 10);
            $table->string('cylinder_right', 10);
            $table->string('cylinder_left', 10);
            $table->string('addition_right', 10);
            $table->string('addition_left', 10);
            $table->string('axis_right', 10);
            $table->string('axis_left', 10);
            $table->timestamps();
            $table->index(['id', 'code', 'customer_id']);
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
