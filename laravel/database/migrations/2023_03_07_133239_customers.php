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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name', 150);
            $table->date('birth_date');
            $table->text('address');
            $table->string('city', 40);
            $table->string('no_handphone', 20);
            $table->string('email', 100)->unique();
            $table->timestamps();
            $table->index(['id', 'code', 'name', 'city', 'no_handphone', 'email']);
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
