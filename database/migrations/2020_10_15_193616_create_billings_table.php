<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('billings')) {
            Schema::create('billings', function (Blueprint $table) {
                $table->id();
                $table->integer('weight');
                $table->integer('shippingcharge');
                $table->integer('dutytax');
                $table->integer('nettotal');
                $table->string('paymentstatus');
                $table->timestamps();
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
        Schema::dropIfExists('billings');
    }
}
