<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_services', function (Blueprint $table) {
            $table->id();

            //reference to clients table
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('Clients');
            //reference to clients table

            //reference to services table
            $table->unsignedBigInteger('services_id');
            $table->foreign('services_id')->references('id')->on('Services');
            //reference to services table

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients_services');
    }
}
