@extends('layouts.admin-app')

@section('content')

    <div class="pageheader">

        <h2><i class="fa fa-home"></i> Dashboard <span>银行卡详情</span></h2>
        {!! Breadcrumbs::render('admin-loan-user-bankCard') !!}
    </div>


    <div class="contentpanel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-btns">
                    <a href="" class="panel-close">×</a>
                    <a href="" class="minimize">−</a>
                </div>
                <h4 class="panel-title">银行卡详情</h4>
                <p><code>点击下方保存即可更新用户银行信息,请谨慎使用!</code></p>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach ($errors->all() as $error)
                        <strong>{{ $error }}!</strong>
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>{{ session('error') }}!</strong>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif

            <div class="panel-body panel-body-nopadding" style="display: block;">
                <form class="form-horizontal form-bordered" action="/admin/user/updateBankCard" method="post">
                    <input type="hidden" name="id" value="{{ $data['id'] }}">

                    <div class="form-group">
                        <label class="col-sm-1 control-label">银行名称</label>
                        <div class="col-sm-3">
                            <input type="text" name="bank_name" value="{{ $data['bank_name'] or null }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label">银行卡号</label>
                        <div class="col-sm-3">
                            <input type="text" name="bank_card_no" value="{{ $data['bank_card_no'] or null }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label">备注</label>
                        <div class="col-sm-3">
                            <input type="text" name="note" value="{{ $data['note'] or null }}" class="form-control">
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


    </div>

@endsection
