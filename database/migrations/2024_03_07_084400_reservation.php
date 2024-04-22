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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('business');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('menu');
            $table->integer('quantity');
            $table->string('type');
            $table->integer('token');
            $table->integer('status')->default(0);
            $table->dateTime('expires_at');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        //
    }
};
