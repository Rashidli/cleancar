<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('contact_translations')){
            Schema::create('contact_translations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('contact_id');
                $table->string('locale')->index();
                $table->string('title');
                $table->timestamps();

                $table->unique(['contact_id', 'locale']);
                $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
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
        Schema::dropIfExists('contact_translations');
    }
}
