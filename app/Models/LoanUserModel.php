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

class LoanUserModel extends CommonScopeModel{

    const   SYSTEM_USER = 1,
            STATUS_COMMON = 200,
            STATUS_ERROR = 500,

            TYPE_PERSON = 1,
            TYPE_COMPANY = 2,



            END = 0;

    protected $table = 'loan_user';

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
        'phone', 'real_name', 'identity_card', 'balance', 'type', 'level', 'status', 'note'
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
     * @param $userId
     * @param $cash
     * @param string $note
     * @param int $eventId
     * @return mixed
     * @throws \Exception
     * @desc 扣除账户余额
     */
    public function decreaseBalance($userId, $cash, $note='', $eventId = FundHistoryModel::EVENT_ID_DECREASE_BALANCE)
    {

        $cash = abs($cash);

        ValidateModel::isInt($userId);

        ValidateModel::isDecimal($cash);

        ValidateModel::isInt($eventId);

        $updateResult = self::where('id', $userId)
            ->where('balance', '>=', $cash)
            ->update(['balance' => \DB::raw(sprintf('`balance`-%.2f', $cash))]);

        if( !$updateResult ){

            throw new \Exception(LangModel::getLang('ERROR_USER_DECREASE_BALANCE'), self::getFinalCode('decreaseBalance'));

        }

        $userInfo = $this->getDetailByWhere(['id' => $userId]);

        $data = [
            'user_id'           => $userId,
            'balance_before'    => $userInfo['balance'] + $cash,
            'balance_change'    => $cash,
            'balance'           => $userInfo['balance'],
            'event_id'          => $eventId,
            'note'              => $note,
        ];

        $fundModel = new FundHistoryModel();

        $insertId = $fundModel->doAdd($data);

        if( !$insertId ){

            throw new \Exception(LangModel::getLang('ERROR_USER_DECREASE_BALANCE'), self::getFinalCode('decreaseBalance'));

        }

        return $insertId;

    }

    /**
     * @param $id
     * @param $cash
     * @return mixed
     * @throws \Exception
     * 增加账户余额
     */
    public function increaseBalance($userId, $cash, $note='', $eventId = FundHistoryModel::EVENT_ID_DECREASE_BALANCE){

        $cash = abs($cash);

        ValidateModel::isInt($userId);

        ValidateModel::isDecimal($cash);

        ValidateModel::isInt($eventId);

        $updateResult = self::where('id', $userId)
            ->update(['balance' => \DB::raw(sprintf('`balance`+%.2f', $cash))]);

        if( !$updateResult ){

            throw new \Exception(LangModel::getLang('ERROR_USER_DECREASE_BALANCE'), self::getFinalCode('decreaseBalance'));

        }

        $userInfo = $this->getDetailByWhere(['id' => $userId]);

        $data = [
            'user_id'           => $userId,
            'balance_before'    => $userInfo['balance'] - $cash,
            'balance_change'    => $cash,
            'balance'           => $userInfo['balance'],
            'event_id'          => $eventId,
            'note'              => $note,
        ];

        $fundModel = new FundHistoryModel();

        $insertId = $fundModel->doAdd($data);

        if( !$insertId ){

            throw new \Exception(LangModel::getLang('ERROR_USER_DECREASE_BALANCE'), self::getFinalCode('decreaseBalance'));

        }

        return $insertId;

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

        if( isset($where['phone']) && !empty($where['phone']) ){

            $param['phone'] = $where['phone'];

        }

        if( isset($where['identity_card']) && !empty($where['identity_card']) ){

            $param['identity_card'] = $where['identity_card'];

        }

        return $this->where($param)->first();

    }

    /**
     * @param array $where
     * @return mixed
     * @desc 获取列表 仅支持手机号、账户类型 、状态
     */
    public function getListByWhere($where=[]){

        $param = [];

        if( isset($where['phone']) && !empty($where['phone']) ){

            $param['phone'] = $where['phone'];

        }

        if( isset($where['type']) && !empty($where['type']) ){

            $param['type'] = $where['type'];

        }

        if( isset($where['status']) && !empty($where['status']) ){

            $param['status'] = $where['status'];

        }

        if( isset($where['identity_card']) && !empty($where['identity_card']) ){

            $param['identity_card'] = $where['identity_card'];

        }

        if( isset($where['id']) && !empty($where['id']) ){

            $param['id'] = $where['id'];

        }

        $size  = isset($where['size']) ? $where['size'] : 10;

        return $this->where($param)
            ->orderBy('id', 'desc')
            ->paginate($size);

    }


    /**
     * @desc 通过多个ID获取用户信息
     * @userIds array
     * @return array
     */
    public function getLoanUserByIds( $userIds )
    {
        if( empty($userIds) )
            return [];
        return $this->whereIn( 'id' , $userIds )
            ->get()
            ->toArray();
    }


}
