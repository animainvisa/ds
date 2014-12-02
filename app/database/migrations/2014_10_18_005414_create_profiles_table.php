<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function($table)
		{
			$table->increments('id');
			$table->integer('account_id')->unsigned();
			$table->foreign('account_id')->references('id')->on('accounts');

			$table->string('occupation');
			$table->string('height');
			$table->string('want_kids');
			$table->string('kids_home');
			$table->string('ethnicity');
			$table->string('religion');
			$table->string('drinks');
			$table->string('smokes');
			$table->string('body_type');
			$table->string('education');
			$table->string('marital_status');
			$table->string('pets');
			$table->string('longest_relationship');
			$table->string('drugs');
			$table->string('eye_color');

			$table->text('about');

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
		Schema::drop('profiles');
	}

}
