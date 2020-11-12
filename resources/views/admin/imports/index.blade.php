@extends('admin.layouts.application')

@section('content')
    <div data-pages="parallax">
        <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner">
                <div class="row" style="padding-left: 10px">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý tài khoản</li>
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
                            <div class="row">
                                <div class="col-md-4 col-md-offset-3">
                                    {{Form::open(['route' => 'admin.import.song', 'enctype' => 'multipart/form-data'])}}
                                    <div class="form-group">
                                        <label>File</label>
                                        {{Form::file('song_file', ['class' => 'form-control'])}}
                                        @error('song_file')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Import</button>
                                    </div>
                                    {{Form::close()}}
                                </div>
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
        let options = null;
        @if(session('alert_successfully'))
             options = {
                    'message': '{{session('alert_successfully')}}',
                    'position': 'top-right',
                    'type': 'success',
                }
            showNotification(options)
        @endif
        @if(session('alert_failed'))
             options = {
                    'message': '{{session('alert_failed')}}',
                    'position': 'top-right',
                    'type': 'error',
                }
            showNotification(options)
        @endif
    </script>
@endsection
