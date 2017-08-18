<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('loan_user', function (Blueprint $table) {
            $table->increments('id')->comment('借款用户表');
            $table->char('phone', 20)->default('')->comment('手机号');
            $table->char('real_name', 20)->default('')->comment('姓名');
            $table->char('identity_card', 20)->unique()->default('')->comment('身份证唯一');
            $table->decimal('balance', 20, 2)->unsigned()->default(0)->comment('账户余额');
            $table->enum('type', [1, 2])->default(1)->comment('用户类型;1:个人;2:企业');
            $table->tinyInteger('level')->default(1)->comment('级别');
            $table->integer('status')->default(200)->comment('状态;200:正常;500:异常');
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
