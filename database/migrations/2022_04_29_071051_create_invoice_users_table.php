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
        Schema::create('invoice_users', function (Blueprint $table) {
            $table->foreignId('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('invoice');
            $table->string("product_category");
            $table->string("product_name");
            $table->integer("product_quantity");
            $table->string('shipping_address');
            $table->string('postal_code');
            $table->integer('total_price');
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
        Schema::dropIfExists('invoice_users');
    }
};
