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
                    {!! Form::open(['method' => 'GET']) !!}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Song name</label>
                                {{Form::text('title', isset($params['title']) ? $params['title'] : null, ['class' => 'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Category</label>
                                {{Form::select('category', $categories, isset($params['category']) ? $params['category'] : 0, ['class' => 'form-control', 'data-init-plugin' => "select2"])}}
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group" style="margin-top: 28%;">
                                <button type="submit" class="btn btn-complete">Search</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-lg-12 no-padding p-t-10">
            <div class="card card-transparent">
                <div class="card-body no-padding">
                    <div id="card-advance" class="card card-default">
                        <div class="card-header">
                            Total: {{$songs->total()}} songs
                            <a href="{{route('song.add')}}" class="btn btn-primary float-right">Create new</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed" id="condensedTable">
                                    <thead>
                                    <tr>
                                        <th style="width:5%">No.</th>
                                        <th>Image</th>
                                        <th style="width:40%">Song name </th>
                                        <th style="width: 20%;">Category</th>
                                        <th>Viewed</th>
                                        <th>liked</th>
                                        <th>Author</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($songs) == 0)
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <h3>Data not found</h3>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($songs as $key => $song)
                                            <tr>
                                                <td class="v-align-middle semi-bold">{{ $index + $key}}</td>
                                                <td class="v-align-middle">
                                                    <img src="{{$song->image}}" style="width: 50px; height: 50px">
                                                </td>
                                                <td class="v-align-middle">{{$song->title}}</td>
                                                <td class="v-align-middle"> {{$song->category->name}}</td>
                                                <td>{{number_format($song->view)}}</td>
                                                <td>{{number_format($song->liked)}}</td>
                                                <td>{{$song->author}}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="{{route('song.edit', ['id' => $song->id])}}">
                                                        <i class="fa fa-edit">  Edit</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="paging_custom">
                                    {!! $songs->links() !!}
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

@endsection
