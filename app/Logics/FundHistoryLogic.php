<?php
/**
 * Created by PhpStorm.
 * User: liuqiuhui
 * Date: 2017/4/19
 * Time: 下午5:32
 */

namespace App\Logics;


use App\Models\FundHistoryModel;
use App\Models\ValidateModel;
use App\Models\LoanUserModel;
use App\Tools\ToolArray;
use Log;

class FundHistoryLogic extends BaseLogic
{

    protected $model = '';

    public function __construct()
    {

        $this->model = new FundHistoryModel();

    }

    /**
     * @param $userId
     * @param $balance 操作后金额
     * @param $cash
     * @param $eventId
     * @param $note
     * @return array
     */
    public function createFundHistory($userId, $balance, $cash, $eventId, $note=''){

        $data = [

                'user_id'           => $userId,
                'balance_change'    => $cash,
                'balance'           => $balance,
                'event_id'          => $eventId,
                'note'              => $note,
        ];


        return $this->model->doAdd($data);

    }

    /**
     * @desc 获取用户资金流水的列表
     * @param $data array
     * @return array
     */
    public function getListByWhere( $data )
    {

        $condition = $this->formatCondition( $data );

        $result  =  $this->model->getListByWhere( $condition );

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
        ( isset( $data['user_id'] ) && !empty( $data['user_id'] ) ) ? $condition['user_id'] = $data['user_id'] : '';
        ( isset( $data['event_id'] ) && !empty( $data['event_id'] ) ) ? $condition['event_id'] = $data['event_id'] : '';
        ( isset( $data['size'] ) && !empty( $data['size'] ) ) ? $condition['size'] = $data['size'] : '';

        return $condition;
    }

}
