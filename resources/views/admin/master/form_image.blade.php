<?php
    $url = route('admin.master.images.post');
    if (isset($image)) {
        $url = route('admin.master.images.update', ['id' => $image->id]);
    }
?>
@extends('admin.layouts.application')



@section('content')
    <div data-pages="parallax">
        <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner">
                <div class="row" style="padding-left: 10px">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid container-fixed-lg">
        <div class="col-lg-12 no-padding p-t-30">
            <div class="card card-transparent">
                <div class="card-body no-padding">
                    <div id="card-advance" class="card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                {{ Form::open(array('url' => $url)) }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Url image</label>
                                            {{Form::url('url', isset($image) ? $image->url : null, ['class' => 'form-control', 'id' => 'url_id'])}}
                                            @error('url')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Image type</label>
                                            {{Form::select('img_type', $listImageType, isset($image) ? $image->img_type : null, ['class' => 'form-control'])}}
                                        </div>
                                        <div class="form-group">
                                            <a href="{{route('admin.master.images.list')}}">
                                                <i class="fa fa-backward"></i>
                                                Back to list
                                            </a>
                                            <button class="btn btn-success" type="submit">Save</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image view</label>
                                            <img style="width: 100%; height: 300px" src="{{isset($image) ? $image->url : ''}}" alt="" id="img_view">
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            let elementUrl = $('#url_id')
            let elementImgView = $('#img_view')
            elementUrl.on('change', function () {
                let value = $(this).val();
                elementImgView.attr('src', value)
            })
        })
    </script>
@endsection
