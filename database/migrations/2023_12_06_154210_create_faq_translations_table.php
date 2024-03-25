<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('faq_translations')){
            Schema::create('faq_translations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('faq_id');
                $table->string('locale')->index();
                $table->string('title');
                $table->text('content');
                $table->timestamps();

                $table->unique(['faq_id', 'locale']);
                $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
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
        Schema::dropIfExists('faq_translations');
    }
}
