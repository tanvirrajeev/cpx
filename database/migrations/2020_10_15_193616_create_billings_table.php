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
                $table->unsignedBigInteger('shippingcharge_id')->nullable();
                $table->unsignedBigInteger('order_id');
                $table->decimal('shippingcharge', 8, 2)->default(0)->nullable();
                $table->decimal('productprice',10,2)->default(0)->nullable();
                $table->decimal('dutytax',10,2)->default(0)->nullable();
                $table->decimal('nettotal',10,2)->default(0)->nullable();
                $table->string('paymentstatus')->default('NOT PAYED')->nullable();
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
