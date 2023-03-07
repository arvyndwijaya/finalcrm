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
            $table->increments('id');
            $table->string('code', 10)->unique();
            $table->string('name', 150);
            $table->integer('customer_id')->unsigned();
            $table->string('spheris_right', 10);
            $table->string('spheris_left', 10);
            $table->string('cylinder_right', 10);
            $table->string('cylinder_left', 10);
            $table->string('addition_right', 10);
            $table->string('addition_left', 10);
            $table->string('axis_right', 10);
            $table->string('axis_left', 10);
            $table->string('no_handphone', 20);
            $table->string('email')->unique();
            $table->timestamps();
            $table->index(['id', 'code', 'customer_id', 'no_handphone', 'email']);
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_receipts');
    }
};
