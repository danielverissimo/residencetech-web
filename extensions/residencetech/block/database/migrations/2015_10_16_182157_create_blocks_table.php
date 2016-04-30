<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blocks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->unsignedInteger('apartment_complex_id');
			$table->timestamps();

			$table->foreign('apartment_complex_id')->references('id')->on('apartmentcomplexes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blocks', function(Blueprint $table)
		{
			$table->dropForeign('blocks_apartment_complex_id_foreign');
		});
		Schema::drop('blocks');
	}

}
