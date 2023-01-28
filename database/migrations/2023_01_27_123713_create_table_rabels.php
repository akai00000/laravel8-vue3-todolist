<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRabels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rabels', function (Blueprint $table) {
            $table->bigIncrements('rabel_id');
            $table->string('rabel');
            $table->Integer('user_id')->comment('ログインユーザーのID');
            $table->Integer('status')->comment('論理削除用カラム');
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
        Schema::dropIfExists('table_rabels');
    }
}
