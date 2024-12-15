<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_usd_infos', function(Blueprint $table) {
			$table->bigIncrements('id')->comment('id');
            $table->string('show_order_id')->unique()->comment('show_order_id');
            $table->string('name')->comment('name');
            $table->json('address')->comment('address');
            $table->decimal('price', 10, 2)->unsigned()->comment('price');
            $table->enum('currency', ['TWD', 'USD', 'JPY', 'RMB', 'MYR'])->default('USD')->comment('currency');
            $table->timestamps();
            $table->softDeletes();

            // for unique
            $uniqueArray = array(
            );

            foreach ($uniqueArray as $u) {
                $table->unique($u);
            }

            // for index
            $indexArray = array(
                'show_order_id',
                'name',
                'created_at',
                'updated_at',
                'deleted_at',
            );

            foreach ($indexArray as $i) {
                $table->index($i);
            }
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_usd_infos');
	}
};
