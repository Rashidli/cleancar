<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ban_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ban_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->timestamps();

            $table->unique(['ban_id', 'locale']);
            $table->foreign('ban_id')->references('id')->on('bans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ban_translations');
    }
}
