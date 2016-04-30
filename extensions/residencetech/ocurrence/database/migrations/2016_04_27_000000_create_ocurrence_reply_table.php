<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcurrenceReplyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ocurrence_reply', function(Blueprint $table)
		{
			$table->increments('id');
			$table->longText('data');
			$table->integer('person_id')->unsigned();
			$table->integer('ocurrence_id')->unsigned()->nullable();

			$table->timestamps();
		});

		Schema::table('ocurrence_reply', function(Blueprint $table)
		{
			// Error to create this foreign
			// $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
			$table->foreign('ocurrence_id')->references('id')->on('ocurrences')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::drop('ocurrence_reply');
	}

}
