@extends('layouts.admin-app')

@section('content')

    <div class="pageheader">

        <h2><i class="fa fa-home"></i> Dashboard <span>债权列表</span></h2>
        {!! Breadcrumbs::render('admin-credit') !!}
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">×</a>
                <a href="" class="minimize">−</a>
            </div>
            <h4 class="panel-title">表单搜索</h4>
            <p> <code>表单搜索,支持债权id、债权名称、债权状态、还款方式、合同编号及项目id等条件搜索!</code></p>
        </div>
        <div class="panel-body panel-body-nopadding" style="display: block;">

            @if(Session::has('message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                    {{ Session::get('message') }}
                </div>
            @endif
            <form class="form-horizontal form-bordered" method="get" action="/admin/credit/list">

                <div class="form-group">
                    <label class="col-sm-1 control-label">债权id</label>
                    <div class="col-sm-2">
                        <input type="text" name="id" value="{{ $search_form['id'] or null }}" placeholder="债权ID" class="form-control">
                    </div>

                    <label class="col-sm-1 control-label">债权名称</label>
                    <div class="col-sm-2">
                        <input type="text" name="loan_name" placeholder="债权名称" value="{{ $search_form['loan_name'] or null }}" class="form-control">
                    </div>

                    <label class="col-sm-1 control-label">债权状态</label>
                    <div class="col-sm-2">
                        <select name="status_code" class="form-control input-sm mb15">
                            <option value="0">默认不选</option>
                            @forelse( $status as $key => $val )
                            <option value="{{ $key }}">{{ $val }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-1 control-label">还款方式</label>
                    <div class="col-sm-2">
                        <select name="repayment_method" class="form-control input-sm mb15">
                            <option value="0">默认不选</option>
                            <option value="10">到期还本息</option>
                            <option value="20">按月付息,到期还本</option>
                            <option value="20">投资当日付息,到期还本</option>
                            <option value="40">等额本息</option>
                        </select>
                    </div>
                    <label class="col-sm-1 control-label">合同编号</label>
                    <div class="col-sm-2">
                        <input type="text" name="contract_no" value="{{ $search_form['contract_no'] or null }}"  placeholder="合同编号" class="form-control">
                    </div>
                    <label class="col-sm-1 control-label">项目id</label>
                    <div class="col-sm-2">
                        <input type="text" name="project_id" placeholder="项目ID" class="form-control">
                    </div>
                </div>
                <div class="panel-footer" style="display: block;">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-1">
                            <input type="submit" value="搜索" class="btn btn-primary">&nbsp;
                            <input type="reset" value="重置" class="btn btn-default">
                            @if( !empty( $search_form['status_code'] ) )
                            @if( $search_form['status_code'] == \App\Models\LoanUserCreditModel::STATUS_CODE_REFUNDING )
                                <input type="button" value="提现处理" onClick='javascript:location.href="/admin/credit/refunding/export?status_code= {{$search_form['status_code']}} "' class="btn btn-default">
                            @endif
                            @endif
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </form>
       </div>
   </div>
    <div class="contentpanel">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>债权名称</th>
                        <th>借款金额</th>
                        <th>平台管理费</th>
                        <th>利率</th>
                        <th>还款方式</th>
                        <th>借款周期</th>
                        <th>融资时间</th>
                        <th>合同编号</th>
                        <th>债权状态</th>
                        <th>项目ID</th>
                        <th>平台还款利息</th>
                        <th>债权人还款利息</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $credit)
                            <tr>
                                <td>{{ $credit['id'] }}</td>
                                <td>{{ $credit['loan_name'] }}</td>
                                <td>{{ $credit['loan_amounts'] }} 元</td>
                                <td>{{ $credit['manage_fee'] or 0 }} 元</td>
                                <td>{{ $credit['interest_rate'] }} %</td>
                                <td>{{ $credit['repayment_method_note'] }}</td>
                                <td>{{ $credit['loan_deadline'] }} @if( $credit['repayment_method'] == 10 ) 天 @else 月 @endif</td>
                                <td>{{ $credit['loan_days'] }} 天</td>
                                <td>{{ $credit['contract_no'] }}</td>
                                <td><span class="label label-warning">{{ $status[$credit['status_code']] or '未知' }}</span></td>
                                <td>{{ $credit['project_id'] }}</td>
                                <td>{{ $credit['refund_interest'] }}</td>
                                <td>{{ $credit['credit_interest'] }}</td>
                                <td>
                                    <a href="/admin/user/userList?id={{ $credit['user_id'] }}" class="btn btn-info btn-xs"><i class="fa fa-info"></i> 用户详情</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="10">暂无信息</td></tr>
                        @endforelse
                    </tbody>

                </table>
                {!! $data->render() !!}

            </div><!-- table-responsive -->
        </div>

    </div><!-- contentpanel -->
@endsection
