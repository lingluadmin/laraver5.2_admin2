<?php

/**
 * Created by PhpStorm.
 * User: liuqiuhui
 * Date: 2017/4/20
 * Time: 上午10:14
 */
namespace App\Http\Requests\Admin\LoanUser;

use App\Http\Requests\Admin\Request;

class BalanceChangeRequest extends Request
{

    public function rules()
    {
        return [
            'phone' => 'required|digits:11|exists:loan_user',
            'cash'  => 'required|numeric',
            'type'  => 'required|in:1,0',
            'note'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'phone.required'    => '手机号必填',
            'phone.digits'      => '手机号必须为11位数字',
            'phone.exists'      => '手机号不存在',
            'cash.required'     => '金额必填',
            'cash.numeric'      => '金额为数字',
            'type.required'     => '类型必选',
            'type.in'           => '类型参数错误',
            'note.required'     => '备注必填',
        ];
    }

}