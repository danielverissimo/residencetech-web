<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonApartmentComplexTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartmentcomplex_person', function(Blueprint $table)
        {

            $table->integer('person_id');
            $table->integer('apartmentcomplex_id');
            $table->primary(['person_id', 'apartmentcomplex_id']);
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
        Schema::drop('apartmentcomplex_person');
    }

}
