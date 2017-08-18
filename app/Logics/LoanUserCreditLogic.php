<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2017/4/18
 * Time: 上午11:25
 * Desc: 借款人债权相关
 */

namespace App\Logics;

use App\Models\FundHistoryModel;
use App\Models\LoanUserCreditModel;
use App\Models\LoanUserModel;
use App\Models\UserBankCardModel;
use App\Tools\ToolArray;
use App\Tools\ToolTime;
use App\Tools\ExportFile;

class LoanUserCreditLogic extends BaseLogic{

    protected $model = '';

    public function __construct()
    {

        $this->model = new LoanUserCreditModel();

    }

    /**
     * @param array $where
     * @return mixed
     * @desc 获取列表
     */
    public function getListByWhere( $data=[] ){

        $where = $this->formatCondition( $data );

        $result = $this->model->getListByWhere($where);

        return $result;

    }

    /**
     * @desc 获取所有的债权列表不分页
     * @author linguanghui
     * @param $data array
     * @return array
     */
    public function getListAllByWhere( $data = [] )
    {
        $where  = $this->formatCondition( $data );

        $result = $this->model->getListAllByWhere( $where );

        return $result;
    }

    /**
     * @desc 格式化列表条件
     * @param $data array
     * @return array
     */
    public static function formatCondition( $data )
    {
        $condition = [];

        ( isset( $data['id'] ) && !empty( $data['id'] ) ) ? $condition['id'] = $data['id'] : '';
        ( isset( $data['loan_name'] ) && !empty( $data['loan_name'] ) ) ? $condition['loan_name'] =  $data['loan_name']  : '';
        ( isset( $data['repayment_method'] ) && !empty( $data['repayment_method'] ) ) ? $condition['repayment_method'] =  $data['repayment_method']  : '';
        ( isset( $data['status_code'] ) && !empty( $data['status_code'] ) ) ? $condition['status_code'] =  $data['status_code']  : '';
        ( isset( $data['project_id'] ) && !empty( $data['project_id'] ) ) ? $condition['project_id'] =  $data['project_id']  : '';
        ( isset( $data['contract_no'] ) && !empty( $data['contract_no'] ) ) ? $condition['contract_no'] =  $data['contract_no']  : '';
        ( isset( $data['size'] ) && !empty( $data['size'] ) ) ? $condition['size'] = $data['size'] : '';

        return $condition;
    }

    /**
     * @param array $where
     * @return mixed
     * @desc 获取单个信息
     */
    public function getDetailByWhere($where=[]){

        $result = $this->model->getDetailByWhere($where);

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

        self::beginTransaction();

        $userBankModel = new UserBankCardModel();

        try{

            $insertId = $this->model->doAddOrUpdate($data, $id);

            $bankInfo = [
                'user_id'       => $insertId,
                'bank_name'     => $data['bank_name'],
                'bank_card_no'  => $data['bank_card_no']
            ];

            $userBankModel->doAddOrUpdate($bankInfo);

            return self::callSuccess($insertId);

        }catch (\Exception $e){

            return self::callError($e->getMessage());

        }

    }

    /**
     * @param $data
     * @return array|\Illuminate\Http\JsonResponse
     * @desc 发布债权
     */
    public function doPublishCredit($data){

        $creditInfo = $this->checkInfoExistByCreditId($data);

        if( !$creditInfo['status'] ){

            return $creditInfo;

        }

        if( $creditInfo['data']['status_code'] == LoanUserCreditModel::STATUS_CODE_REFUNDING ){

            return self::callError($creditInfo['data']['status_code'].'状态已处理');

        }

        if( $creditInfo['data']['status_code'] != LoanUserCreditModel::STATUS_CODE_WAIT ){

            return self::callError($creditInfo['data']['status_code'].'状态异常');

        }

        $updateData = [
            'project_id'            => $data['project_id'],
            'status_code'           => LoanUserCreditModel::STATUS_CODE_INVEST,
            'project_publish_rate'  => $data['project_publish_rate']
        ];

        try{

            $insertId = $this->model->doAddOrUpdate($updateData, $creditInfo['data']['id']);

            return self::callSuccess($insertId);

        }catch (\Exception $e){

            \Log::Error(__CLASS__.__METHOD__.'Error', ['data' => $updateData, 'msg' => $e->getMessage()]);

            return self::callError($e->getMessage(), '', $data);

        }

    }

    /**
     * @param array $data
     * @return array
     * @desc 批量添加用户以及其对应债权信息
     */
    public function batchCreateCredit($data=[]){

        if(empty($data)){

            return self::callError('参数不能为空');

        }

        //执行插入
        try{

            $this->model->insert($data);

            return self::callSuccess();

        }catch (\Exception $e){

            \Log::Error(__CLASS__.__METHOD__.'Error', ['data' => $data, 'msg' => $e->getMessage()]);

            return self::callError('批量添加债权信息失败');

        }

    }

    /**
     * @param $data
     * @return array
     * @desc 满标放款,更新债权状态并且更新债权利息、增加账户余额、扣除手续费
     */
    public function makeLoans($data){

        $checkResult = $this->checkInfoExistByCreditId($data);

        if( !$checkResult['status'] ){

            return $checkResult;

        }

        if( $checkResult['data']['status_code'] != LoanUserCreditModel::STATUS_CODE_INVEST ){

            return self::callError($checkResult['data']['status_code'].'状态异常');

        }

        $loanUserModel = new LoanUserModel();

        $updateCreditInfo = [
            'interest_rate'     => $data['interest_rate'],
            'loan_days'         => $data['loan_days'],
            'loan_amounts'      => $data['loan_amounts'],
            'credit_interest'   => $data['credit_interest'],
            'status_code'       => LoanUserCreditModel::STATUS_CODE_REFUNDING
        ];

        self::beginTransaction();

        try{

            //更新债权信息
            $this->model->doAddOrUpdate($updateCreditInfo, $checkResult['data']['id']);

            //通过用户Id向账户加钱
            $loanUserModel->increaseBalance($checkResult['data']['user_id'], $data['loan_amounts'], $data['credit_id'].'-放款');

            //执行扣除手续费
            $loanUserModel->decreaseBalance($checkResult['data']['user_id'], $checkResult['data']['manage_fee'], $data['credit_id'].'-服务费扣除');

            self::commit();

            return self::callSuccess();

        }catch (\Exception $e){

            self::rollback();

            return self::callError($e->getMessage(), '', $data);

        }

    }

    /**
     * @param array $data
     * @return array
     * @desc 通过creditId检测信息是否存在
     */
    public function checkInfoExistByCreditId( $data=[] ){

        if( empty($data) || !isset($data['credit_id']) || empty($data['credit_id']) ){

            return self::callError('参数异常');

        }

        $creditInfo = $this->getDetailByWhere(['credit_id' => $data['credit_id']]);

        if( !isset($creditInfo['data']['id']) || $creditInfo['data']['id'] < 1 ){

            return self::callError('信息不存在');

        }

        return $creditInfo;

    }

    /**
     * @param array $data
     * @return array
     * @desc 执行回款标记
     */
    public function doRefund($data=[]){

        $projectId = ToolArray::arrayToIds($data, 'project_id');

        $data = ToolArray::arrayToKey($data, 'project_id');

        $loanUserCreditModel = new LoanUserCreditModel();

        $creditList = $loanUserCreditModel->getListByProjectIds($projectId);

        if( empty($creditList) ){

            return self::callSuccess();

        }

        $loanUserModel = new LoanUserModel();

        $errorData = [];

        $errorMsg = '';

        foreach( $creditList as $item ){


            if( !isset($item['status_code']) || $item['status_code'] != LoanUserCreditModel::STATUS_CODE_WITHDRAW ){

                $errorData[] = $item;

                $errorMsg = '状态异常';

                \Log::error(__METHOD__.__CLASS__.'Error', $item);

                continue;

            }

            //获取
            $loanUserInfo = $loanUserModel->getDetailByWhere(['id' => $item['user_id']]);

            if( empty($loanUserInfo) ){

                $errorData[] = $item;

                $errorMsg = '用户信息不存在';

                \Log::Error(__CLASS__.__METHOD__.'Error', ['msg' => '用户信息不存在', ['data' => $data]]);

                continue;

            }

            $updateCreditInfo = [
                'refund_interest' => $data[$item['project_id']]['total_cash'],
                'status_code'     => LoanUserCreditModel::STATUS_CODE_REFUND
            ];

            self::beginTransaction();

            try{

                $sysCash = round(($item['credit_interest'] + $item['loan_amounts']), 2);

                //更新债权信息
                $this->model->doAddOrUpdate($updateCreditInfo, $item['id']);

                if( $loanUserInfo['balance'] < $item['credit_interest'] ){

                    //通过用户Id向账户加钱
                    $loanUserModel->increaseBalance($item['user_id'], $sysCash, $item['credit_id'].'-还款系统垫付');

                }

                //通过用户Id向账户扣款
                $loanUserModel->decreaseBalance($item['user_id'], $sysCash, $item['credit_id'].'-还款', FundHistoryModel::EVENT_ID_REFUND);

                //通过系统用户Id向账户加钱
                $systemDiffInterest = round(($sysCash - $data[$item['project_id']]['total_cash']), 2);

                $loanUserModel->increaseBalance(LoanUserModel::SYSTEM_USER, $systemDiffInterest, $item['credit_id'].'-平台收益');

                self::commit();

            }catch (\Exception $e){

                self::rollback();

                \Log::Error(__CLASS__.__METHOD__.'Error', ['msg' => $e->getMessage(), 'data' => $item]);

                $errorMsg = $e->getMessage();

            }

        }

        if( empty($errorData) ){

            return self::callSuccess();

        }else{

            return self::callError($errorMsg, '', $errorData);

        }

    }

    /**
     * @desc 执行后台债权导出
     * @author linguanghui
     * @param $data array
     * @return array
     */
    public function doCreditExport( $data  )
    {
        $creditList = $this->getListAllByWhere( $data );

        if( empty( $creditList ) )
        {
            return self::callError( '没有可以导出的债权数据!' );
        }

        //格式化导出的提现数据
        $formatCreditExport =  $this->formatCreditExportList( $creditList );

        $loanUserCreditModel = new LoanUserCreditModel();

        $loanUserModel   =  new LoanUserModel();

        self::beginTransaction();
        try{
            //批量更新债权信息
            $creditIds = ToolArray::arrayToIds( $creditList, 'id' );

            $loanUserCreditModel->batchUpdateCreditStatus( $creditIds, LoanUserCreditModel::STATUS_CODE_WITHDRAW );

            //添加债权用户提现的资金流水记录
            foreach( $creditList as $value )
            {

                $loanUserModel->decreaseBalance($value['user_id'], $value['loan_amounts']- $value['manage_fee'], $value['credit_id'].'-提现扣款', FundHistoryModel::EVENT_ID_WITHDRAW);
                
            }

          //  $fileName = 'export-credit'.ToolTime::dbDate();

          //  ExportFile::csv( $formatCreditExport, $fileName );

                self::commit();
            }catch( \Exception $e ){

                self::rollback();
                \Log::Error(__CLASS__.__METHOD__.'导出满标放款债权数据失败', ['data'=> $creditList, 'msg'=> $e->getMessage() ] );
                return self::callError( $e->getMessage() );
            }
        return self::callSuccess();

    }


    /**
     * @desc 格式化债权数据的导出
     * @param $creditList
     * @return array
     */
    public function formatCreditExportList( $creditList )
    {
        if( empty( $creditList ) )
        {
            return [];
        }

        $loanUserModel = new LoanUserModel();

        $userBankModel = new UserBankCardModel;

        $result[] = ['债权ID','债权名称','债权人姓名','借款人手机号','借款人身份证号','银行卡名称','银行卡号','放款金额','借款利率','还款方式','借款期限','融资时间','合同编号'];

        $userIds = ToolArray::arrayToIds( $creditList, 'user_id' );
        $loanUsers = ToolArray::arrayToKey( $loanUserModel->getLoanUserByIds( $userIds ), 'id' );

        $userBankCards = ToolArray::arrayToKey( $userBankModel->getUserBankCardsByIds( $userIds ), 'user_id' );

        foreach( $creditList as $value )
        {
            $unit = $value['repayment_method'] == 10 ? '天' : '月';
            $result[] = [
                'id'  => $value['id'],
                'loan_name'  => $value['loan_name'],
                'real_name'  => isset( $loanUsers[$value['user_id']]) ? $loanUsers[$value['user_id']]['real_name'] : '',
                'phone'  => isset( $loanUsers[$value['user_id']]) ? $loanUsers[$value['user_id']]['phone'] : '',
                'identity_card'  => isset( $loanUsers[$value['user_id']]) ? $loanUsers[$value['user_id']]['identity_card'] : '',
                'bank_name'  => isset( $userBankCards[$value['user_id']]) ? $userBankCards[$value['user_id']]['bank_name'] : '',
                'bank_card_no'  => isset( $userBankCards[$value['user_id']]) ? $userBankCards[$value['user_id']]['bank_card_no'] : '',
                'loan_amounts'  => $value['loan_amounts'] - $value['manage_fee'].'元',
                'interest_rate'  => $value['interest_rate'].'%',
                'repayment_method_note'  => $value['repayment_method_note'],
                'loan_deadline'  => $value['loan_deadline']. $unit,
                'loan_days'  => $value['loan_days'].'天',
                'contract_no'  => $value['contract_no'],
                ];
        }

        return $result;
    }

}
