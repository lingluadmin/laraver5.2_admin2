<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/28
 * Time: 上午11:16
 * Desc: 资金流水
 */

namespace App\Models;

use App\Lang\LangModel;

class FundHistoryModel extends CommonScopeModel{

    public $timestamps = false;

    const

        EVENT_ID_INCREASE_BALANCE = 100,        //系统充值
        EVENT_ID_DECREASE_BALANCE = 200,        //系统扣款
        EVENT_ID_REFUND           = 201,
        EVENT_ID_WITHDRAW         = 202,     //满标放款提现
    END=true;

    protected $table = 'fund_history';

    public static $codeArr = [
        'doAddOrUpdate'             => 1,
    ];


    public static $expNameSpace = ExceptionCodeModel::EXP_MODEL_BASE;

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'balance_before', 'balance_change', 'balance', 'event_id', 'note'
    ];

    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     * */
     protected $guarded = ['id', 'created_at'];



    /**
     * @param $data
     * @return mixed
     * @desc 执行添加获取更新
     */
    public function doAdd($data){

        $res = self::updateOrCreate(['id' => null], $data);

        if( !$res->id ){

            throw new \Exception(LangModel::getLang('ERROR_COMMON'), self::getFinalCode('doAddOrUpdate'));

        }

        return $res->id;

    }

    /**
     * @desc 设置资金流水的事件标示
     * @return array
     */
    public static function setEventNote( )
    {
        return [
            self::EVENT_ID_INCREASE_BALANCE => '系统充值',
            self::EVENT_ID_DECREASE_BALANCE => '系统扣款',
            self::EVENT_ID_REFUND           => '项目回款',
            self::EVENT_ID_WITHDRAW         => '放款提现'
            ];
    }


    /**
     * @desc 按照条件获取资金流水的列表
     * @param $condition array
     * @return array
     */
    public function getListByWhere( $condition = [] )
    {

        $size  = isset( $condition['size'] ) ? $condition['size'] : 10;

        unset( $condition['size'] );

        return $this->where( $condition )
            ->orderBy( 'id', 'desc' )
            ->paginate( $size );

    }


}
