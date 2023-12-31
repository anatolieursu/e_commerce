<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("id")->on("products");

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");

            $table->string("status")->default("unpaid");

            $table->string("location")->default("shop");
            $table->boolean("completed")->default(false);
            $table->string("sessionID")->default("0");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
