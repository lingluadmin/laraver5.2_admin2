<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/10/28
 * Time: 上午11:16
 * Desc: 用户银行卡
 */

namespace App\Models;

use App\Lang\LangModel;

class UserBankCardModel extends CommonScopeModel{


    protected $table = 'user_bank_card';

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
        'user_id', 'bank_name', 'bank_card_no', 'note'
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
     * @desc 获取银行卡详情
     */
    public function getDetailByWhere($where=[]){

        $param = [];

        if( isset($where['id']) && $where['id'] > 0 ){

            $param['id'] = $where['id'];

        }

        if( isset($where['user_id']) && !empty($where['user_id']) ){

            $param['user_id'] = $where['user_id'];

        }

        if( isset($where['bank_card_no']) && !empty($where['bank_card_no']) ){

            $param['bank_card_no'] = $where['bank_card_no'];

        }

        return $this->where($param)->first();

    }

    /**
     * @desc 通过多个userId获取用户银行卡信息
     * @userIds array 用户id列表
     * @return array
     */
    public function getUserBankCardsByIds( $userIds )
    {
        if( empty($userIds) )
            return [];
        return $this->whereIn( 'user_id' , $userIds )
            ->get()
            ->toArray();
    }



}
