<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('hero_translations')){
            Schema::create('hero_translations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('hero_id');
                $table->string('locale')->index();
                $table->string('title');
                $table->string('content');
                $table->string('text');

                $table->unique(['hero_id', 'locale']);
                $table->foreign('hero_id')->references('id')->on('heroes')->onDelete('cascade');
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
        Schema::dropIfExists('hero_translations');
    }
}
