@extends('layouts.admin-app')

@section('content')

    <div class="pageheader">

        <h2><i class="fa fa-home"></i> Dashboard <span>用户列表</span></h2>
        {!! Breadcrumbs::render('admin-loan-user-list') !!}
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">×</a>
                <a href="" class="minimize">−</a>
            </div>
            <h4 class="panel-title">表单搜索</h4>
            <p> <code>表单搜索,支持身份证号、手机号、Id、用户状态及类型条件搜索!</code></p>
        </div>
        <div class="panel-body panel-body-nopadding" style="display: block;">

            <form class="form-horizontal form-bordered" method="get" action="/admin/user/userList">

                <div class="form-group">
                    <label class="col-sm-1 control-label">ID</label>
                    <div class="col-sm-2">
                        <input type="text" name="id" placeholder="用户ID" class="form-control">
                    </div>

                    <label class="col-sm-1 control-label">手机号</label>
                    <div class="col-sm-2">
                        <input type="text" name="phone" placeholder="用户手机号" class="form-control">
                    </div>

                    <label class="col-sm-1 control-label">身份证</label>
                    <div class="col-sm-2">
                        <input type="text" name="identity_card" placeholder="请输入身份证号码" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-1 control-label">状态</label>
                    <div class="col-sm-2">
                        <select name="status" class="form-control input-sm mb15">
                            <option value="0">默认不选</option>
                            <option value="200">正常</option>
                            <option value="500">异常</option>
                        </select>
                    </div>

                    <label class="col-sm-1 control-label">类型</label>
                    <div class="col-sm-2">
                        <select name="type" class="form-control input-sm mb15">
                            <option value="0">默认不选</option>
                            <option value="1">个人</option>
                            <option value="2">企业</option>
                        </select>
                    </div>
                </div>

                <div class="panel-footer" style="display: block;">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" value="Submit" class="btn btn-primary">&nbsp;
                            <input type="reset" value="Cancel" class="btn btn-default">
                        </div>
                    </div>
                </div><!-- panel-footer -->

            </form>

        </div><!-- panel-body -->

    </div>

    <div class="contentpanel">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>手机号</th>
                        <th>姓名</th>
                        <th>身份证</th>
                        <th>余额</th>
                        <th>类型</th>
                        <th>级别</th>
                        <th>状态</th>
                        <th>备注</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $user)
                            <tr>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['phone'] }}</td>
                                <td>{{ $user['real_name'] }}</td>
                                <td>{{ $user['identity_card'] }}</td>
                                <td>{{ $user['balance'] }}</td>
                                <td>@if($user['type'] == \App\Models\LoanUserModel::TYPE_PERSON)
                                        <span class="label label-info">个人</span> @else
                                        <span class="label label-danger">企业</span>
                                    @endif</td>
                                <td>{{ $user['level'] }} 级</td>
                                <td>@if($user['status'] == \App\Models\LoanUserModel::STATUS_COMMON)
                                        <span class="label label-info">正常</span> @else
                                        <span class="label label-danger">异常</span>
                                    @endif</td>
                                <td>{{ $user['note'] }}</td>
                                <td>{{ $user['created_at'] }}</td>
                                <td>
                                    <a href="/admin/user/bankCard?user_id={{ $user['id'] }}" class="btn btn-info btn-xs"><i class="fa fa-info"></i> 银行卡详情</a>
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
