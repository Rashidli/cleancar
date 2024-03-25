<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('statistic_translations')){
            Schema::create('statistic_translations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('statistic_id');
                $table->string('locale')->index();
                $table->string('title');
                $table->text('content');
                $table->timestamps();

                $table->unique(['statistic_id', 'locale']);
                $table->foreign('statistic_id')->references('id')->on('statistics')->onDelete('cascade');
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
        Schema::dropIfExists('statistic_translations');
    }
}
