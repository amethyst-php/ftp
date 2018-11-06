<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateFtpTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(Config::get('amethyst.ftp.data.ftp.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(Config::get('amethyst.ftp.data.ftp-action.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description')->nullable();

            $table->integer('ftp_id')->unsigned()->nullable();
            $table->foreign('ftp_id')->references('id')->on(Config::get('amethyst.ftp.data.ftp.table'));

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(Config::get('amethyst.ftp.data.ftp.table'));
        Schema::dropIfExists(Config::get('amethyst.ftp.data.ftp-action.table'));
    }
}
