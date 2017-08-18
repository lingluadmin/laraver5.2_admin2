<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Breadcrumbs;
use App\Logics\LoanUserCreditLogic;
use App\Models\LoanUserCreditModel;
use App\Tools\ToolTime;
use App\Tools\ExportFile;

class LoanUserCreditController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-credit', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('债款管理', route('admin.credit.list'));
        });

    }
    /**
     * @desc 债权列表
     */
    public function creditList( Request $request )
    {


        Breadcrumbs::register('admin-credit-list', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-credit');
            $breadcrumbs->push('债权列表', route('admin.credit.list'));
        });

        $logic = new LoanUserCreditLogic();

        $data = $request->all();

        $data['size']  = 10;

        $data['data'] = $logic->getListByWhere( $data );

        $data['status'] = LoanUserCreditModel::setCreditStatus();

        $data['search_form'] = $data;

        return view('admin.credit.list', $data);
    }

    /**
     * @desc 执行满标放款债权导出操作
     * @param  Request $request array
     * @return bool
     */
    public function doCreditRefundingExport( Request $request )
    {
        $data['status_code'] = $request->input( 'status_code', '300');

        $logic = new LoanUserCreditLogic();

        $creditList = $logic->getListAllByWhere( $data );

        if( empty( $creditList) ){

            return redirect()->back()->withInput($request->input())->with('message', '债权数据为空');
        }

        $formatCreditExport =  $logic->formatCreditExportList( $creditList );

        $result =  $logic->doCreditExport( $data );

        if( !$result['status']  ){
            return redirect()->back()->withInput($request->input())->with('message', $result['msg']);
        }

           $fileName = 'export-credit'.ToolTime::dbDate();

           ExportFile::csv( $formatCreditExport, $fileName );

    }
}
