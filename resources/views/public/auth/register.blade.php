@extends('public.layout.master')
@section('metas')
    @include('public.layout.partials.meta-default')
@endsection
@section('content')
    <section class="contact-wrap">
        <div class="container">
            <div class="col-md-4 col-md-offset-4">
                <div class="title top-title">
                </div>
                <div class="title text-center">
                    <h2>Đăng ký thành viên</h2>
                </div>
                {{ Form::open(['route' => 'register']) }}
                <div class="row">
                    <div class="col-md-12">
                        <label>Họ và tên<span class="iconRequired">*</span></label>
                        {{Form::text('name', null, ['placeholder' => 'Họ và tên', 'class' => 'form-control'])}}
                        @error('name')
                        <span class="text-error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>Số điện thoại</label>
                        {{Form::text('phone', null, ['placeholder' => 'Số điện thoại', 'class' => 'form-control'])}}
                        @error('phone')
                        <span class="text-error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>Email<span class="iconRequired">*</span></label>
                        {{Form::email('email', null, ['placeholder' => 'Nhập email', 'class' => 'form-control'])}}
                        @error('email')
                        <span class="text-error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>Mật khẩu<span class="iconRequired">*</span></label>
                        {{Form::password('password', ['placeholder' => 'Nhập mật khẩu', 'class' => 'form-control'])}}
                        @error('password')
                            <span class="text-error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>Xác nhận lại mật khẩu<span class="iconRequired">*</span></label>
                        {{Form::password('password_confirm', ['placeholder' => 'Nhập mật khẩu', 'class' => 'form-control'])}}
                        @error('password_confirm')
                        <span class="text-error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="padding-top: 10px">
                        <input name="submit" style="width: 100%; margin-bottom: 20px" type="submit" class="def-button" value="Đăng ký">
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
