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
                        <div class="card-header">
                            <a href="{{route('admin.master.images.get')}}" class="btn btn-primary">
                                Create new image
                                <i class="fa fa-plus" style="padding-left: 5px"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed" id="condensedTable">
                                    <thead>
                                    <tr>
                                        <th style="width:5%">Id.</th>
                                        <th style="width:10%">Image</th>
                                        <th style="width:20%">Url</th>
                                        <th>Image type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($images) == 0)
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <h3>Data not found</h3>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($images as $key => $image)
                                            <tr>
                                                <td>{{$image->id}}</td>
                                                <td>
                                                    <img width="100%" height="70px" src="{{$image->url}}" alt="">
                                                </td>
                                                <td>
                                                    <a href="{{$image->url}}" target="_blank">{{$image->url}}</a>
                                                </td>
                                                <td>{{\App\Models\Image::$listImageType[$image->img_type]}}</td>
                                                <td>{{$image->status}}</td>
                                                <td>
                                                    <a href="{{route('admin.master.images.edit', ['id' => $image->id])}}"><i class="fa fa-edit"> Edit</i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="paging_custom">
                                    {{$images->links()}}
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
        $(function () {
            @if(session('create_success'))
                let options = {
                    'message': '{{session('create_success')}}',
                    'position': 'top-right',
                    'type': 'success',
                }
                showNotification(options)
            @endif
            @if(session('create_failed'))
                let options = {
                        'message': '{{session('create_failed')}}',
                        'position': 'top-right',
                        'type': 'error',
                    }
                showNotification(options)
            @endif
        })
    </script>
@endsection
