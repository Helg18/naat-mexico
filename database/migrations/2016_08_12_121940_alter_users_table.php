<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
	Schema::table('users', function (Blueprint $table) {
		$table->string('nombre')->after('password');
		$table->string('apellido')->after('nombre');
		$table->string('fecha_nac')->after('apellido');
		$table->string('fecha_ingreso_uvm')->after('fecha_nac');
		$table->string('celular')->after('fecha_ingreso_uvm');
		$table->string('puesto')->after('celular');
		$table->string('campus')->after('puesto');
		$table->string('num_empleado')->after('campus');
		$table->string('metas_ni')->after('num_empleado');
		$table->string('metas_pno')->after('metas_ni');
	});
}

/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
	Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('nombre');
			$table->dropColumn('apellido');
			$table->dropColumn('fecha_nac');
			$table->dropColumn('fecha_ingreso_uvm');
			$table->dropColumn('celular');
			$table->dropColumn('puesto');
			$table->dropColumn('campus');
			$table->dropColumn('num_empleado');
			$table->dropColumn('metas_ni');
			$table->dropColumn('metas_pno');
		});
	}
}
