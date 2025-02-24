<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('referred_service_id')->nullable();
            $table->string('business_type');
            $table->double('price');
            $table->boolean('allow_cancel')->default(0); //Allow user to cancel "confirmed","paid" bookings
            $table->boolean('auto_confirm')->default(0);//Allow user to cancel "confirmed","paid" bookings
            $table->integer('allow_booking_max_day_ago')->default(60);
            $table->time('service_duration')->nullable();
            $table->time('buffer_time')->nullable();
            $table->boolean('multiple_bookings')->default(0); //Allow multiple bookings per service duration
            $table->integer('available_seat')->default(0); //Show spaces left (interval booking)
            $table->longText('description')->nullable();
            $table->string('service_duration_type');
            $table->time('service_starts')->nullable();
            $table->time('service_ends')->nullable();
            $table->date('service_starting_date')->nullable();
            $table->date('service_ending_date')->nullable();
            $table->integer('max_booking');
            $table->string('alias')->nullable();
            $table->integer('created_by');
            $table->boolean('activation')->default(0);
            $table->string('consider_children_for_price');
            $table->integer('age_range');
            $table->decimal('percentage', 8,2);
            $table->string('break_time')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('vendor_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
