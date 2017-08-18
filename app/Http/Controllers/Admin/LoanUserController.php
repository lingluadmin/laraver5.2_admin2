<?php
/**
 * Created by PhpStorm.
 * User: gyl-dev
 * Date: 2017/4/18
 * Time: 下午12:06
 * Desc: 借款人Controller
 */
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LoanUser\BalanceChangeRequest;
use App\Logics\LoanUserLogic;
use App\Logics\FundHistoryLogic;
use App\Models\FundHistoryModel;
use App\Tools\ToolStr;
use Illuminate\Http\Request;
use Breadcrumbs;

class LoanUserController extends BaseController{



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-loan-user', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('债款人管理', route('admin.user.balanceChange'));
        });

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 用户加币减币
     */
    public function balanceChange(){

        Breadcrumbs::register('admin-loan-user-balance-change', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-loan-user');
            $breadcrumbs->push('充值扣款', route('admin.user.balanceChange'));
        });

        return view('admin.loanUser.balanceChange');

    }

    /**
     * @param BalanceChangeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * 充值扣款
     */
    public function doBalanceChange(BalanceChangeRequest $request){

        $logic  = new LoanUserLogic();

        $cash   = $request->input('cash', 0);

        $phone  = $request->input('phone', '');

        $type   = $request->input('type', 0);

        $note   = $request->input('note', '');

        if( $type > 0 ){

            $result = $logic->doIncreaseBalance($phone, $cash, $note);

        }else{

            $result = $logic->doDecreaseBalance($phone, $cash, $note);

        }


        if($result['status']){

            $key = 'message';

        }else{

            $key = 'fail';

        }

        return redirect()->back()->withInput($request->input())->with($key, $result['msg']);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 用户列表
     */
    public function userList( Request $request ){

        Breadcrumbs::register('admin-loan-user-list', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-loan-user');
            $breadcrumbs->push('用户列表', route('admin.user.userList'));
        });

        $logic = new LoanUserLogic();

        $where = $request->all();

        $where['size'] = 10;

        $data['data'] = $logic->getListByWhere($where);

        return view('admin.loanUser.userList', $data);
    }

    /**
     * @desc 用户的资金流水
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userFundHistory( Request $request )
    {

        Breadcrumbs::register('admin-loan-user-fund-history', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-loan-user');
            $breadcrumbs->push('资金流水表', route('admin.user.fundHistory'));
        });

        $fundLogic =  new FundHistoryLogic();

        $data = $request->all();

        $data['data']  = $fundLogic->getListByWhere( $data );

        $data['event']  = FundHistoryModel::setEventNote();

        return view(' admin.loanUser.fundHistory', $data );
    }

    /**
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @desc 银行卡信息
     */
    public function bankCard( Request $request ){

        Breadcrumbs::register('admin-loan-user-bankCard', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-loan-user');
            $breadcrumbs->push('银行卡信息', route('admin.user.bankCard'));
        });

        $userId = $request->input('user_id');

        $logic = new LoanUserLogic();

        $data = $logic->getCardDetailByWhere(['user_id' => $userId]);

        return view('admin.loanUser.bankCard', $data);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @desc 更新银行卡
     */
    public function updateBankCard( Request $request ){

        $data = $request->all();

        $id = $data['id'];

        unset($data['id']);

        $logic = new LoanUserLogic();

        $result = $logic->doUpdateBankCard($data, $id);

        if( $result['status'] ){

            return redirect()->back()->withInput($request->input())->with('success', '操作成功');

        }else{

            return redirect()->back()->withInput($request->input())->with('error', $result['msg']);

        }

    }

}
