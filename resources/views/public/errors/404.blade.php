@extends('public.layout.master')
@section('metas')
    @include('endUser.layouts.meta-default')
@endsection
@section('content')
    <section class="error-wrap">
        <div class="container">
            <div class="error">
                <div class="shape"><div class="big-title"><h1>404</h1></div></div>
                <div class="title">
                    <h1>Xin lỗi, nội dung trang này không được tìm thấy.</h1>
                </div>
                <div class="subtitle"><a href="/"><h2>Quay về trang chủ</h2></a></div>
            </div>
        </div><!-- /.container -->
    </section>
@endsection
