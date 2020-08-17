<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('sales')->onDelete('cascade');

            $table->bigInteger('from')->unsigned();
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');

            $table->text('offer');
            $table->boolean('closed')->default(false);
            $table->string('reason_for_close', 128)->nullable()->default(NULL);

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
        Schema::dropIfExists('offers');
    }
}
