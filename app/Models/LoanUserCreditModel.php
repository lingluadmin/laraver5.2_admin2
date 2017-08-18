<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/28
 * Time: 上午11:16
 * Desc: 借款人账户信息
 */

namespace App\Models;

use App\Lang\LangModel;

class LoanUserCreditModel extends CommonScopeModel{

    const   STATUS_CODE_WAIT            = 100,  //待融资
            STATUS_CODE_INVEST          = 200,  //投标中
            STATUS_CODE_REFUNDING       = 300,  //满标已放款
            STATUS_CODE_OVERDUE         = 400,  //逾期
            STATUS_CODE_OVERDUE_REFUND  = 500,  //逾期还款
            STATUS_CODE_REFUND          = 600,  //正常还款
            STATUS_CODE_WITHDRAW        = 700,  //已经提现

            YEAR_DAY                    = 365,
            YEAR_MONTH                  = 12,
            RATE_PERCENT                = 100,


        THE_END   = null;

    protected $table = 'loan_user_credit';

    public static $codeArr = [
        'doAddOrUpdate'             => 1,
        'decreaseBalance'           => 2,
        'increaseBalance'           => 3,
    ];


    public static $expNameSpace = ExceptionCodeModel::EXP_MODEL_BASE;

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_name', 'loan_amounts', 'manage_fee', 'interest_rate', 'project_publish_rate', 'repayment_method', 'repayment_method_note', 'loan_deadline', 'loan_days', 'contract_no', 'status_code', 'credit_id', 'project_id', 'refund_interest', 'credit_interest'
    ];

    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     * */
     protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
     * @param $data
     * @return mixed
     * @desc 执行添加获取更新
     */
    public function doAddOrUpdate($data, $id=0){

        if( $id ){

            $res = self::updateOrCreate(['id' => $id], $data);

        }else{

            $res = self::updateOrCreate(['id' => null], $data);

        }

        if( !$res->id ){

            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('doAddOrUpdate'));

        }

        return $res->id;

    }

    /**
     * @param array $where
     * @return mixed
     * @desc 查询条件获取单个信息,仅支持id、手机号、身份证
     */
    public function getDetailByWhere($where=[]){

        $param = [];

        if( isset($where['id']) && $where['id'] > 0 ){

            $param['id'] = $where['id'];

        }

        if( isset($where['project_id']) && !empty($where['project_id']) ){

            $param['project_id'] = $where['project_id'];

        }

        if( isset($where['credit_id']) && !empty($where['credit_id']) ){

            $param['credit_id'] = $where['credit_id'];

        }

        return $this->where($param)->first();

    }

    /**
     * @param array $where
     * @return mixed
     * @desc 获取列表信息
     */
    public function getListByWhere($where=[]){

        $param = [];

      //  if( isset($where['user_id']) && $where['user_id'] > 0 ){

      //      $param['user_id'] = $where['user_id'];

      //  }

      //  if( isset($where['status_code']) && !empty($where['status_code']) ){

      //      $param['status_code'] = $where['status_code'];

      //  }

        $size  = isset($where['size']) ? $where['size'] : 10;

        unset( $where['size'] );

        return $this->where( $where )
            ->orderBy('id', 'desc')
            ->paginate($size);

    }

    /**
     * @desc 获取债权所有列表不分页
     * @author linguanghui
     * @param $where array 搜索条件
     * @return array
     */
    public function getListAllByWhere( $where )
    {
        return $this->where( $where )
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * @param $projectIds
     * @return mixed
     * @desc 通过项目id获取列表
     */
    public function getListByProjectIds($projectIds){

        return $this->whereIn('project_id', $projectIds)
            ->get()
            ->toArray();

    }

    /**
     * @desc 批量更新债权状态
     * @param $creditIds 债权id列表
     * @param $statusCode int 要更新的状态值
     * @return bool|Expection
     */
    public function batchUpdateCreditStatus( $creditIds, $statusCode )
    {
        if( empty( $creditIds ) || empty( $statusCode ) )
        {
            throw new \Exception( '债权ID活更新的状态不能为空', self::getFinalCode('batchUpdateCreditStatus') );
        }

        $res = self::whereIn( 'id', $creditIds )
            ->update( ['status_code' => $statusCode ]);

        if( !$res )
        {
            throw new \Exception( '更新债权状态失败', self::getFinalCode( 'batchUpdateCreditStatus' ) );
        }

        return $res;
    }

    /**
     * @desc 设置债权的状态值
     * @return array
     */
    public static function setCreditStatus( )
    {
        return [
            self::STATUS_CODE_WAIT => '待融资',
            self::STATUS_CODE_INVEST => '投标中',
            self::STATUS_CODE_REFUNDING => '满标放款',
            self::STATUS_CODE_OVERDUE => '逾期',
            self::STATUS_CODE_OVERDUE_REFUND => '逾期还款',
            self::STATUS_CODE_REFUND => '正常还款',
            self::STATUS_CODE_WITHDRAW => '放款提现'
            ];
    }


}
