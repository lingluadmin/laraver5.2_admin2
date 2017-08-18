<?php

/**
 * Class LoanUserTest
 * @desc 借款人相关入口
 */

class LoanUserTest extends TestCase
{

    public function userData(){

        return [
            [true, 0, [
                'phone'         => 1,
                'real_name'     => 'sys1',
                'identity_card' => 1,
                'bank_name'     => 1,
                'bank_card_no'  => 1
            ]],
            [true, 0, [
                'phone'         => 13661321001,
                'real_name'     => 'name1',
                'identity_card' => 13661321001,
                'bank_name'     => '招商银行',
                'bank_card_no'  => 13661321001
            ]],
            [true, 0, [
                'phone'         => 13161781368,
                'real_name'     => 'name1',
                'identity_card' => 13161781368,
                'bank_name'     => '招商银行',
                'bank_card_no'  => 13661321001
            ]],
            [false, 0, [
                'phone'         => 13661321001,
                'real_name'     => 'name1',
                'identity_card' => 13661321001,
                'bank_name'     => '招商银行',
                'bank_card_no'  => 13661321001
            ]],//添加重复账户
            [true, 2, [
                'status'        => 500
            ]],//更新已存在账户状态
        ];

    }

    public function testTruncate(){

        \DB::table('loan_user')->truncate();

        \DB::table('loan_user_credit')->truncate();

        \DB::table('fund_history')->truncate();

        \DB::table('user_bank_card')->truncate();

    }

    /**
     * @param $result
     * @param array $data
     * @dataProvider userData
     */
    public function testAdd($exceptResult, $id, $data=[]){

        $logic = new \App\Logics\LoanUserLogic();

        //$result = $logic->doAddOrUpdate($data, $id);

        //$this->assertEquals($exceptResult, $result['status']);


    }

    /**
     * @desc 获取用户信息
     */
    public function testGetUserInfo()
    {

        $logic = new \App\Logics\LoanUserLogic();

        //$result = $logic->getDetailByWhere(['identity_card' => 13661321001]);

        //$this->assertEquals(13661321001, $result['data']['identity_card']);

    }

    public function batchCreateCreditAndUser(){

        return [
            [true, [
                [
                    'loan_type'                  => '1',
                    'loan_phone'                 => 13661321002,
                    'loan_username'             => 'name2',
                    'loan_user_identity'         => 13661321002,

                    'credit_name'             => 'loan_name'.rand(1,100),
                    'loan_amounts'          => 1000,
                    'manage_fee'            => 10,
                    'interest_rate'         => 20,
                    'repayment_method'      => 'repayment_method',
                    'repayment_method_note' => 'repayment_method_note',
                    'loan_deadline'         => 20,
                    'loan_days'             => 'loan_days',
                    'contract_no'           => 'contract_no',
                    'credit_id'             => 1,
                    'bank_name'             => '招商银行',
                    'bank_card'          => 13661321002
                ]
            ]]
        ];

    }

    /**
     * @param $result
     * @param $data
     * @dataProvider batchCreateCreditAndUser
     */
    public function testBatchCreateCreditAndUser($result, $data){

        $logic = new \App\Logics\LoanUserLogic();

        $res = $logic->batchCreateUserAndCredit($data);

        $this->assertEquals($result, $res['status']);

    }

    public function balanceChangeData(){

        return [
            [
                'result'    => true,
                'id'        => 2,
                'cash'      => 10000,
                'type'      => 1,
                'note'      => '充值'
            ],
            [
                'result'    => true,
                'id'        => 2,
                'cash'      => 1000.99,
                'type'      => 0,
                'note'      => '扣款'
            ],
            [
                'result'    => false,
                'id'        => 0,
                'cash'      => 1000.99,
                'type'      => 0,
                'note'      => '扣款'
            ],
            [
                'result'    => false,
                'id'        => 0,
                'cash'      => 'ssssss',
                'type'      => 0,
                'note'      => '扣款'
            ],
            [
                'result'    => false,
                'id'        => 2,
                'cash'      => 1000000.99,
                'type'      => 0,
                'note'      => '扣款'
            ],

        ];

    }

    /**
     * @param $exceptResult
     * @param $userId
     * @param $cash
     * @param $type
     * @dataProvider balanceChangeData
     * 账户余额操作
     */
    public function testBalanceChange($exceptResult, $userId, $cash, $type, $note){

        $logic = new \App\Logics\LoanUserLogic();

        if($type){

            //$result = $logic->doIncreaseBalance($userId, $cash, $note);

        }else{

            //$result = $logic->doDecreaseBalance($userId, $cash, $note);

        }

        //$this->assertEquals($exceptResult, $result['status']);

    }

    public function publishCredit(){

        return [
            [true, [
                'credit_id'                 => 1,
                'project_publish_rate'      => 10,
                'project_id'                => 1
            ]]
        ];

    }
    /**
     * @param $exceptResult
     * @param $data
     * @desc 发布项目
     * @dataProvider publishCredit
     */
    public function testDoPublishCredit($exceptResult, $data){

        $logic = new \App\Logics\LoanUserCreditLogic();

        $result = $logic->doPublishCredit($data);

        $this->assertEquals($exceptResult, $result['status']);

    }

    public function makeLoanData(){

        return [
            [
                true, 1, 100, 30, 300, 20
            ]
        ];

    }

    /**
     * @param $exceptResult
     * @param $creditId 债权id
     * @param $creditInterest 债权利息
     * @param $refundInterest   项目还款利息
     * @dataProvider makeLoanData
     */
    public function testDoMakeLoans($exceptResult, $creditId, $creditInterest, $interestRate, $loanAmounts, $loanDays){

        $logic = new \App\Logics\LoanUserCreditLogic();

        $result = $logic->makeLoans(['credit_id' => $creditId, 'interest_rate' => $interestRate, 'loan_days' => $loanDays, 'loan_amounts' => $loanAmounts, 'credit_interest' => $creditInterest]);

        $this->assertEquals($exceptResult, $result['status']);

    }


    public function refundData(){

        return [
            [true, [
                [
                    'project_id' => 1,
                    'total_cash' => 100
                ]
            ]],
        ];

    }

    /**
     * @param $exceptResult
     * @param $creditId
     * @param $refundInterest
     * @desc 通知执行回款扣除
     * @dataProvider refundData
     */
    public function testDoRefund($exceptResult, $data ){


        $logic = new \App\Logics\LoanUserCreditLogic();

        $result = $logic->doRefund($data);

        $this->assertEquals($exceptResult, $result['status']);

    }
}
