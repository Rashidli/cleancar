<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToWashingServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('washing_services')){
            Schema::table('washing_services', function (Blueprint $table) {
                $table->unsignedBigInteger('ban_id');
                $table->decimal('price');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('washing_services', function (Blueprint $table) {
            //
        });
    }
}
