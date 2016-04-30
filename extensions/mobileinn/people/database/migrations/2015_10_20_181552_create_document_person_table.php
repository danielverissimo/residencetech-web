<?php

 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Database\Migrations\Migration;

class CreateDocumentPersonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_person', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('document_type_id')->unsigned();
			$table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('restrict');
			$table->integer('person_id')->unsigned();
			$table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
			$table->string('document');
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
		Schema::table('document_person', function(Blueprint $table)
		{
		    $table->dropForeign('document_person_person_id_foreign');
		    $table->dropForeign('document_person_document_type_id_foreign');
		});
		Schema::drop('document_person');
	}

}
