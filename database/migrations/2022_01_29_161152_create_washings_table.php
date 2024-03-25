<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWashingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('washings', function (Blueprint $table) {
            $table->id();
            $table->string('washing_name');
            $table->string('owner_name');
            $table->text('image');
            $table->text('address');
            $table->enum('status', ['0', '1'])->default('0');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('lat')->nullable()->default(null);
            $table->string('lon')->nullable()->default(null);
            $table->string('sedan_price')->nullable()->default(null);
            $table->string('jeep_price')->nullable()->default(null);
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
        Schema::dropIfExists('washings');
    }
}
