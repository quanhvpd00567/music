@extends('public.layout.master')
@section('metas')
    @include('endUser.layouts.meta-default')
@endsection
@section('content')
    <section class="contact-wrap">
        <div class="container">
            <div class="col-md-4 col-md-offset-4">
                <div class="title top-title">
                </div>
                <div class="title text-center">
                    <h2>lOGIN</h2>
                </div>
                {{ Form::open(['route' => 'login']) }}
                <div class="row">
                    <div class="col-md-12">
                        <label>Email<span class="iconRequired">*</span></label>
                        {{Form::email('email', null, ['placeholder' => 'Nhập email', 'class' => 'form-control'])}}
                        @error('email')
                        <span class="text-error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>Password<span class="iconRequired">*</span></label>
                        {{Form::password('password', ['placeholder' => 'Nhập mật khẩu', 'class' => 'form-control'])}}
                        @error('password')
                            <span class="text-error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="padding-top: 10px">
                        <a href="">Quên mật khẩu</a>
                        <input name="submit" style="width: 100%; margin-bottom: 20px" type="submit" class="def-button" value="Đăng nhập">
                        <a class="btn facebook-btn btn-block" style="color: white; background-color: #1877f2" href="{{route('socialite_login', ['provider' => 'facebook'])}}" >
                            <i class="fa fa-facebook"></i> Login with facebook
                        </a>
                    </div>
                </div>
                {{ Form::close() }}
            </div><!--/.left -->
        </div><!-- /.container -->
    </section>
@endsection
