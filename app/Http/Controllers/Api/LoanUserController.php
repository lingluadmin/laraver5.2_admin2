<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2017/4/18
 * Time: 下午12:08
 * Desc: 借款人相关接口
 */

namespace App\Http\Controllers\Api;

use App\Logics\BaseLogic;
use App\Logics\LoanUserCreditLogic;
use App\Logics\LoanUserLogic;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LoanUserController extends Controller{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @desc 获取用户信息
     */
    public function getUserInfo(Request $request){

        $data = $request->input('data');

        $identityCard = $data['identity_card'];

        if( empty($identityCard) ){

            return response()->json(BaseLogic::callError('参数不正确'));

        }

        $loanUserLogic = new LoanUserLogic();

        $result = $loanUserLogic->getDetailByWhere(['identity_card' => $identityCard]);

        \Log::info('API_'.__METHOD__.'_LOG', $result);

        return response()->json($result);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @desc 批量添加债权及借款人
     */
    public function batchCreateUserAndCredit( Request $request ){

        $data = $request->input('data');

        $loanUserLogic = new LoanUserLogic();

        $result = $loanUserLogic->batchCreateUserAndCredit($data);

        \Log::info('API_'.__METHOD__.'_LOG', $result);

        return response()->json($result);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @desc 更新债权信息【暂时没用,启用时请调试】
     */
    public function doUpdateCreditInfo( Request $request ){

        $data = $request->input('data');

        $creditId = $data['credit_id'];

        $loanUserCreditLogic = new LoanUserCreditLogic();

        $creditInfo = $loanUserCreditLogic->getDetailByWhere(['credit_id' => $creditId]);

        if( !isset($creditInfo['data']['id']) || $creditInfo['data']['id'] < 1 ){

            \Log::info('API_'.__METHOD__.'_LOG', $creditInfo);

            return response()->json(BaseLogic::callError('信息不存在'));

        }

        $result = $loanUserCreditLogic->doAddOrUpdate($data, $creditId);

        \Log::info('API_'.__METHOD__.'_LOG', $result);

        return response()->json($result);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @desc 发布项目更新债权
     */
    public function doPublishCredit( Request $request ){

        $data = $request->input('data');

        $loanUserCreditLogic = new LoanUserCreditLogic();

        $result = $loanUserCreditLogic->doPublishCredit($data);

        \Log::info('API_'.__METHOD__.'_LOG', $result);

        return response()->json($result);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @desc 满标放款
     */
    public function makeLoans( Request $request ){

        $data = $request->input('data');

        $loanUserCreditLogic = new LoanUserCreditLogic();

        $result = $loanUserCreditLogic->makeLoans($data);

        \Log::info('API_'.__METHOD__.'_LOG', $result);

        return response()->json($result);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @desc 执行还款
     */
    public function doRefundNotice( Request $request ){

        $data = $request->input('data');

        $loanUserCreditLogic = new LoanUserCreditLogic();

        $result = $loanUserCreditLogic->doRefund($data);

        \Log::info('API_'.__METHOD__.'_LOG', $result);

        return response()->json($result);

    }

}
