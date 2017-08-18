<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBankCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_bank_card', function (Blueprint $table) {
            $table->increments('id')->comment('用户银行卡');
            $table->integer('user_id')->comment('用户id');
            $table->char('bank_name', 50)->comment('银行名称');
            $table->char('bank_card_no', 50)->unique()->comment('银行卡号');
            $table->char('note', 50)->default('')->comment('备注,备用字段');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
