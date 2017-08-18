<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2017/4/18
 * Time: 上午11:25
 * Desc: 借款人的相关逻辑
 */

namespace App\Logics;

use App\Models\FundHistoryModel;
use App\Models\LoanUserCreditModel;
use App\Models\LoanUserModel;
use App\Models\UserBankCardModel;
use App\Models\ValidateModel;

class LoanUserLogic extends BaseLogic{

    protected $model = '';
    protected $bankModel = '';

    public function __construct()
    {

        $this->model = new LoanUserModel();

    }

    /**
     * @param array $where
     * @return mixed
     * @desc 获取列表
     */
    public function getListByWhere($where=[]){

        return $this->model->getListByWhere($where);

    }

    /**
     * @param array $where
     * @return mixed
     * @desc 获取单个信息
     */
    public function getDetailByWhere($where=[]){

        $model = $this->model;

        $result = $model->getDetailByWhere($where);

        return self::callSuccess($result);

    }

    /**
     * @param array $where
     * @return array
     * @desc 获取银行卡详情
     */
    public function getCardDetailByWhere($where=[]){

        $model = new UserBankCardModel();

        $result = $model->getDetailByWhere($where);

        return self::callSuccess($result);

    }

    /**
     * @param $data
     * @return array
     * @desc 执行添加或者更新
     */
    public function doAddOrUpdate($data, $id=0){

        if( empty($data) ){

            return self::callError('信息不能为空');

        }

        try{

            $insertId = $this->model->doAddOrUpdate($data, $id);

            return self::callSuccess($insertId);

        }catch (\Exception $e){

            return self::callError($e->getMessage());

        }

    }

    /**
     * @param $data
     * @param $id
     * @return array
     * @desc 更新银行卡信息
     */
    public function doUpdateBankCard($data, $id){

        if( empty($data) ){

            return self::callError('信息不能为空');

        }

        $model = new UserBankCardModel();

        try{

            $insertId = $model->doAddOrUpdate($data, $id);

            return self::callSuccess($insertId);

        }catch (\Exception $e){

            return self::callError($e->getMessage());

        }

    }

    /**
     * @param $id
     * @param $cash
     * @param $note
     * @return mixed
     * @throws \Exception
     * 增加账户余额
     */
    public function doIncreaseBalance($userId, $cash, $note='', $eventId = FundHistoryModel::EVENT_ID_INCREASE_BALANCE){

        self::beginTransaction();

        try{

            $this->model->increaseBalance($userId, $cash, $note, $eventId);

            self::commit();

            return self::callSuccess();

        }catch (\Exception $e){

            self::rollback();

            return self::callError($e->getMessage());

        }

    }

    /**
     * @param $id
     * @param $cash
     * @param $note
     * @return mixed
     * @throws \Exception
     * 扣除账户余额
     */
    public function doDecreaseBalance($userId, $cash, $note='', $eventId = FundHistoryModel::EVENT_ID_DECREASE_BALANCE){

        self::beginTransaction();

        try{

            $this->model->decreaseBalance($userId, $cash, $note, $eventId);

            self::commit();

            return self::callSuccess();

        }catch (\Exception $e){

            self::rollback();

            return self::callError($e->getMessage());

        }

    }

    /**
     * @param array $data
     * @return array
     * @desc 批量添加用户以及其对应债权信息
     */
    public function batchCreateUserAndCredit($data=[]){

        if(empty($data)){

            return self::callError('参数不能为空');

        }

        $createCreditData = [];

        $loanUserCreditModel = new LoanUserCreditModel();

        $userBankModel = new UserBankCardModel();

        foreach( $data as $key => $item ){

            if( empty($item) ){

                continue;

            }

            $userId = 0;

            //这里循环查询插入有待优化
            $userInfo = $this->model->getDetailByWhere(['identity_card' => $item['loan_user_identity']]);

            if( !isset($userInfo['id']) || $userInfo['id'] < 1 ){

                //插入新数据
                $createUserData = [
                    'phone'         => $item['loan_phone'],
                    'real_name'     => $item['loan_username'],
                    'identity_card' => $item['loan_user_identity'],
                    'type'          => $item['loan_type']
                ];


                try{

                    $userId = $this->model->doAddOrUpdate($createUserData);

                    $bankInfo = [
                        'user_id'           => $userId,
                        'bank_name'         => $item['bank_name'],
                        'bank_card_no'      => $item['bank_card']
                    ];

                    $userBankModel->doAddOrUpdate($bankInfo);

                }catch (\Exception $e){

                    $errorCreditData[] = $item;

                    \Log::Error(__CLASS__.__METHOD__.'CreateUserAndBankError', ['data' => $errorCreditData ,'msg' => $e->getMessage()]);

                    continue;
                }

            }else{

                $userId = $userInfo['id'];

            }

            $loanUserCreditInfo = $loanUserCreditModel->getDetailByWhere(['credit_id' => $item['credit_id']]);

            if( isset($loanUserCreditInfo['id']) || $loanUserCreditInfo['id']>0 ){

                $item['user_id'] = $userId;

                $errorCreditData[] = $item;

                continue;

            }

            //批量插入,也可以把流程修改为进度队列等待执行
            $createCreditData[] = [
                'user_id'               => $userId,
                'loan_name'             => $item['credit_name'],
                'loan_amounts'          => $item['loan_amounts'],
                'manage_fee'            => $item['manage_fee'],
                'interest_rate'         => $item['interest_rate'],
                'repayment_method'      => $item['repayment_method'],
                'repayment_method_note' => $item['repayment_method_note'],
                'loan_deadline'         => $item['loan_deadline'],
                'loan_days'             => $item['loan_days'],
                'contract_no'           => $item['contract_no'],
                'credit_id'             => $item['credit_id']
            ];

        }

        if( empty($createCreditData) ){

            return self::callError('债权列表信息为空');

        }else{

            $loanUserCreditLogic = new LoanUserCreditLogic();

            $batchCreateResult = $loanUserCreditLogic->batchCreateCredit($createCreditData);

            if( !$batchCreateResult['status'] ){

                return self::callError('批量添加债权信息失败');

            }

            if( !empty($errorCreditData) ){

                \Log::Error(__CLASS__.__METHOD__.'CreateCreditError', $errorCreditData);

                return self::callError('部分债权添加失败', '', $errorCreditData);

            }

        }

        return self::callSuccess();

    }


}
