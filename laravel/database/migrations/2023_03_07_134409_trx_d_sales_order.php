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
        Schema::create('trx_d_sales_order', function (Blueprint $table) {
            $table->id();
            $table->integer('so_h_id');
            $table->integer('material_id');
            $table->string('material_code', 10);
            $table->string('material_name', 200);
            $table->decimal('material_price', 10, 2);
            $table->integer('qty');
            $table->index(['id', 'so_h_id', 'material_id', 'material_code', 'material_name']);
            $table->foreign('so_h_id')->references('id')->on('trx_h_sales_order');
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
