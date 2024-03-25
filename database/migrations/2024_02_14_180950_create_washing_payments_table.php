<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWashingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('washing_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('washing_id');
            $table->unsignedBigInteger('package_id');
            $table->timestamps();

            $table->foreign('washing_id')->references('id')->on('washings')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('washing_payments');
    }
}
