<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('region_translations')){
            Schema::create('region_translations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('region_id');
                $table->string('locale')->index();
                $table->string('title');
                $table->timestamps();

                $table->unique(['region_id', 'locale']);
                $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
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
        Schema::dropIfExists('region_translations');
    }
}
