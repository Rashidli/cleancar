<?php

use App\Enum\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('reservation_statuses')){
            Schema::create('reservation_statuses', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('reservation_id');
                $table->unsignedBigInteger('user_id');
                $table->tinyInteger('user_type');
                $table->enum('status', [Status::APPROVED, Status::CANCELLED, Status::COMPLETED])
                    ->default(Status::APPROVED)
                    ->comment('1 - Approved, 2 - Cancelled, 3 - Completed');
                $table->timestamps();

                $table->foreign('reservation_id')->references('id')->on('reservations');
                $table->foreign('user_id')->references('id')->on('users');
            });
        }


        Schema::create('reservation_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('user_type');
            $table->enum('status', [Status::APPROVED, Status::CANCELLED, Status::COMPLETED])
                ->default(Status::APPROVED)
                ->comment('1 - Approved, 2 - Cancelled, 3 - Completed');
            $table->timestamps();

            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_statuses');
    }
}
