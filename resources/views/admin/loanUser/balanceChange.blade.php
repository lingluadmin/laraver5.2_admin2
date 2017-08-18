@extends('layouts.admin-app')

@section('content')

    <div class="pageheader">

        <h2><i class="fa fa-home"></i> Dashboard <span>充值扣款</span></h2>
        {!! Breadcrumbs::render('admin-loan-user-balance-change') !!}
    </div>

    <div class="contentpanel">

        <div class="row">

            <div class="col-lg-16">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">充值扣款</h4>
                    </div>

                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>  <i class="icon icon fa fa-warning"></i> 提示！</h4>
                            {{ Session::get('fail') }}
                        </div>
                    @endif

                    <form class="form-horizontal form-bordered" action="{{ route('admin.user.doBalanceChange') }}" method="POST">

                        <div class="panel-body panel-body-nopadding">

                            <div class="form-group">
                                <label class="col-sm-1 control-label">手机号 <span class="asterisk">*</span></label>

                                <div class="col-sm-2">
                                    <input type="text"  data-toggle="tooltip" name="phone"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="请填写手机号" value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">金额 <span class="asterisk">*</span></label>

                                <div class="col-sm-2">
                                    <input type="text"  data-toggle="tooltip" name="cash"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="请填写操作金额" value="{{ old('cash') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">备注 <span class="asterisk">*</span></label>

                                <div class="col-sm-3">
                                    <input type="text"  data-toggle="tooltip" name="note"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="请填写备注,方便流水核对" value="{{ old('note') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">操作类型 <span class="asterisk"></span></label>

                                <div class="col-sm-2">
                                    <select class="form-control input-sm" name="type">
                                        <option value="0" {{ old('type') == 0 ? 'selected':'' }}>扣款</option>
                                        <option value="1" {{ old('type') == 1 ? 'selected':'' }}>充值</option>
                                    </select>
                                </div>
                            </div>

                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->
                    </form>

                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div><!-- contentpanel -->
@endsection
