<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vision_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vision_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('content');

            $table->unique(['vision_id', 'locale']);
            $table->foreign('vision_id')->references('id')->on('visions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vision_translations');
    }
}
