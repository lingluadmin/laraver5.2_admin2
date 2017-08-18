<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanUserCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('loan_user_credit', function(Blueprint $table)
        {
            $table->increments('id')->comment('用户借款债权记录');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->char('loan_name', 100)->comment('债权名称');
            $table->decimal('loan_amounts',20,2)->unsigned()->default(0)->comment('借款金额');
            $table->decimal('manage_fee',20,2)->default(0)->comment('平台服务管理费');
            $table->decimal('interest_rate',5,2)->unsigned()->default(0)->comment('利率');
            $table->decimal('project_publish_rate',5,2)->unsigned()->default(0)->comment('项目发布利率');
            $table->tinyInteger('repayment_method')->unsigned()->default(0)->comment('还款方式字段');
            $table->char('repayment_method_note', 50)->default('')->comment('还款方式名称');
            $table->integer('loan_deadline')->unsigned()->default(0)->comment('借款期限(天)');
            $table->integer('loan_days')->unsigned()->default(0)->comment('融资时间(天)');
            $table->char('contract_no', 100)->default('')->comment('合同编号');
            $table->integer('status_code')->default(100)->comment('状态:100-待融资，200-融资中 300，已放款');
            $table->integer('project_id')->default(0)->comment('项目id');
            $table->decimal('refund_interest',20,2)->default(0)->comment('平台还款利息');
            $table->decimal('credit_interest',20,2)->default(0)->comment('债权人还款利息');
            $table->integer('credit_id')->default(0)->unique()->comment('债权id,用于平台间对接');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->index('user_id');
            $table->index('contract_no');
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
