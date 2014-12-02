<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBdayGenderOrientationColumnsToAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accounts', function($table)
		{
			$table->date('birthdate')->after('password');
			$table->string('gender')->after('birthdate');;
			$table->string('sexual_orientation')->after('gender');;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('accounts', function($table)
		{
			$table->dropColumn(array('birthdate', 'gender', 'sexual_orientation'));
		});
	}

}
