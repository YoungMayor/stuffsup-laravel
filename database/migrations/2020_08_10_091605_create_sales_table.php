<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('token', 64);
            $table->string('title', 256);
            $table->text('description');
            $table->double('price', 15, 2)->default(0.00);

            $table->bigInteger('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('phone', 32)->nullable();
            $table->string('category', 32);

            $table->boolean('is_public')->default(true);
            $table->boolean('is_open')->default(true);
            $table->string('reason_for_close', 128)->nullable();

            $table->dateTime('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
