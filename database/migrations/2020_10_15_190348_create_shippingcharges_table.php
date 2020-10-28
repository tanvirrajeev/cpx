<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingchargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('shippingcharges')) {
            Schema::create('shippingcharges', function (Blueprint $table) {
                $table->id();
                $table->decimal('weight',5,2);
                $table->integer('factor');
                $table->decimal('rate',5,2);
                $table->decimal('amount',10,2);
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
        Schema::dropIfExists('shippingcharges');
    }
}
