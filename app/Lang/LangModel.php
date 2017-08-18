<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 16/4/15
 * Time: 下午4:37
 * Desc: Model 操作提示信息
 */

namespace App\Lang;

class LangModel
{

    const

        SUCCESS_COMMON                                          = '操作成功',
        ERROR_COMMON                                            = '操作失败',
        ERROR_USER_DECREASE_BALANCE                             = '账户余额扣款失败',
        ERROR_USER_INCREASE_BALANCE                             = '账户余额充值失败',
        ERROR_IS_EMPTY                                          = '数据为空',

        /******************************************这里是分割线************************************************/


        
        ERROR_END                                             = null;


    /**
     * @param $name
     * @return string
     */
    public static function getLang($name)
    {

        $className = __CLASS__;

        $lang = defined("$className::$name") ? constant("$className::$name") : $name;

        return $lang;

    }

}