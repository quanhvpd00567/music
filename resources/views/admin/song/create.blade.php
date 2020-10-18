@extends('admin.layouts.application')

@section('content')

    <div data-pages="parallax">
        <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner">
                <div class="row" style="padding-left: 10px">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Song clone</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid container-fixed-lg">

        <div class="col-lg-12 no-padding p-t-30">
            <div class="card card-default">
                <div class="card-body">

                </div>
            </div>
        </div>

        <div class="col-lg-12 no-padding p-t-10">
            <div class="card card-transparent">
                <div class="card-body no-padding">
                    <div id="card-advance" class="card card-default">
                        <div class="card-body">
                            @include('admin.song._form', ['url' => route('song.create')])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
