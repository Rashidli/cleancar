<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('suggestion_translations')){
            Schema::create('suggestion_translations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('suggestion_id');
                $table->string('locale')->index();
                $table->string('title');
                $table->string('ban');
                $table->string('service');
                $table->timestamps();

                $table->unique(['suggestion_id', 'locale']);
                $table->foreign('suggestion_id')->references('id')->on('suggestions')->onDelete('cascade');
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
        Schema::dropIfExists('suggestion_translations');
    }
}
