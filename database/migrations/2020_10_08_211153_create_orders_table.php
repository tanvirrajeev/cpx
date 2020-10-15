<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->unsignedbigInteger('users_id');
                $table->string('ecomordid');
                $table->string('ecomname');
                $table->string('ecomproddesc');
                $table->string('ecomorddt');
                $table->string('consigneename');
                $table->string('consigneeaddrs');
                $table->string('ecomprdtraclnk')->nullable();
                $table->string('ecomsppngpriority');
                $table->string('ecomrcvby')->nullable();
                $table->string('ecomawb')->nullable();
                $table->string('note')->nullable();
                $table->string('ecomstatus');
                $table->string('awb')->nullable();
                $table->string('updatedby');
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
        Schema::dropIfExists('orders');
    }
}
