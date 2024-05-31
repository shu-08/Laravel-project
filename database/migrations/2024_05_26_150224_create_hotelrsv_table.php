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
        Schema::create('hotelrsv', function (Blueprint $table) {
            $table->increment('id')->primary();
            $table->date('date');
            $table->string('name',10);
            $table->string('email',30);
            $table->integer('totalUser');
            $table->integer('adult');
            $table->integer('child');
            $table->integer('senior');
            $table->integer('stateid');
            $table->integer('price');
            $table->text('remarks');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotelrsv');
    }
};
