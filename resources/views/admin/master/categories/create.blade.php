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
                            @include('admin.master.categories._from', ['url' => route('admin.master.category.post', ['id' => $idWebsite]),
                                        'idWebsite' => $idWebsite, 'category' => $category])
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

        })
    </script>
@endsection



