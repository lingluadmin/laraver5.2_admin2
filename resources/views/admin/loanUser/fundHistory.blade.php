@extends('layouts.admin-app')

@section('content')

    <div class="pageheader">

        <h2><i class="fa fa-home"></i> Dashboard <span>资金流水表</span></h2>
        {!! Breadcrumbs::render('admin-loan-user-fund-history') !!}
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">×</a>
                <a href="" class="minimize">−</a>
            </div>
            <h4 class="panel-title">表单搜索</h4>
            <p> <code>表单搜索,支持Id、用户id，资金流水类型条件搜索!</code></p>
        </div>
        <div class="panel-body panel-body-nopadding" style="display: block;">
            <form class="form-horizontal form-bordered" method="get" action="/admin/user/fundHistory">

                <div class="form-group">
                    <label class="col-sm-1 control-label">流水表ID</label>
                    <div class="col-sm-2">
                        <input type="text" name="id" value="{{ old('id') }}" placeholder="流水表ID" class="form-control">
                    </div>

                    <label class="col-sm-1 control-label">用户ID</label>
                    <div class="col-sm-2">
                        <input type="text" name="user_id" placeholder="用户ID" class="form-control">
                    </div>

                    <label class="col-sm-1 control-label">资金流水类型</label>
                    <div class="col-sm-2">
                        <select name="event_id" class="form-control input-sm mb15">
                            <option value="0">默认不选</option>
                            @forelse( $event as $key => $val )
                            <option value="{{ $key }}">{{ $val }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="panel-footer" style="display: block;">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-1">
                            <input type="submit" value="搜索" class="btn btn-primary">&nbsp;
                            <input type="reset" value="充值" class="btn btn-default">
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
                        <th>借款人id</th>
                        <th>变更前金额</th>
                        <th>变更金额</th>
                        <th>变更后金额</th>
                        <th>事件类型</th>
                        <th>备注</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $fund)
                            <tr>
                                <td>{{ $fund['id'] }}</td>
                                <td>{{ $fund['user_id'] }}</td>
                                <td>{{ $fund['balance_before'] }} 元</td>
                                <td>{{ $fund['balance_change'] }} 元</td>
                                <td>{{ $fund['balance'] }} 元</td>
                                <td> {{ $event[$fund['event_id']] }} </td>
                                <td>{{ $fund['note'] }}</td>
                                <td>{{ $fund['created_at'] }}</td>
                                <td>
                                    <a href="/admin/user/userList?id={{ $fund['user_id'] }}" class="btn btn-info btn-xs"><i class="fa fa-info"></i> 借款人详情</a>
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
