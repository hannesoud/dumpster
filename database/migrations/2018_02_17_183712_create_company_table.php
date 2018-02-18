<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email',255)->unique();
            $table->string('license', 255);
            $table->mediumText('details');
            $table->string('address',155);
            $table->string('phone', 255);
            $table->string('password');
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
        Schema::dropIfExists('w_company');
    }
}
