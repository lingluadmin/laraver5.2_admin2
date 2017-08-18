@extends('layouts.admin-login')

@section('content')
    <div class="row">

        <div class="col-md-7">

            <div class="signin-info">
                <div class="logopanel">
                    <h1><span>[</span> 债权管理系统 <span>]</span></h1>
                </div><!-- logopanel -->

                <p>
                    <img src="/images/admin-icon.png" width="300">
                </p>

            </div><!-- signin0-info -->

        </div><!-- col-sm-7 -->

        <div class="col-md-5">
            <form method="post" action="{{ url('/admin/login') }}">
                @if($errors->first())
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>{{ $errors->first() }}!</strong>
                    </div>
                @endif
                <h4 class="nomargin">登录</h4>
                <input type="text" name="email" class="form-control uname" placeholder="邮箱"/>
                <input type="password" name="password" class="form-control pword" placeholder="密码"/>
                <div class="checkbox">
                    <input type="checkbox" name="remember"> 记住我
                </div>
                <a href="#" onclick="alert('请联系管理员!')">
                    <small>忘记密码?</small>
                </a>
                <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-success btn-block">确认登录</button>
            </form>
        </div><!-- col-sm-5 -->

    </div><!-- row -->
@endsection