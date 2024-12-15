<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRoleFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');  // role カラムを削除
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role');  // 必要なら戻す処理
        });
    }

}
