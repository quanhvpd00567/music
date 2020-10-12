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
                <table class="table table-hover table-condensed" id="condensedTable">
                    <thead>
                    <tr>
                        <th style="width:5%">No.</th>
                        <th style="width:15%">Site name</th>
                        <th>Category clone</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Run batch</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($categories) == 0)
                        <tr>
                            <td colspan="9" class="text-center">
                                <h3>Data not found</h3>
                            </td>
                        </tr>
                    @else
                        @foreach($categories as $key => $category)
                            <tr>
                                <td class="v-align-middle semi-bold">{{$key + 1}}</td>
                                <td class="v-align-middle">
                                    {{$category->masterSite->name}}
{{--                                    <span class="badge badge-success">{{count($site->masterCategories)}}</span>--}}
                                </td>
                                <td>
                                    {{$category->category->name}}
                                </td>
                                <td class="v-align-middle">
                                    <a href="{{$category->masterSite->website . '/'. $category->category_clone}}" target="_blank" class="text-link">
                                        {{$category->category_clone}}
                                    </a>
                                </td>
                                <td>
                                    @if($category->status == \App\Models\MasterSite::$status['clone'])
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-important">Not Active</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-check-inline switch">
                                        <input type="checkbox" class="remix-run-batch" id="{{'pagesSwitch' . $category->id}}" {{$category->status == \App\Models\MasterSite::$batch['run'] ? 'checked' : ''}}>
                                        <label for="{{'pagesSwitch' . $category->id}}">
                                            {{$category->status == \App\Models\MasterSite::$batch['run'] ? 'Running' : 'Stopped' }}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    aa
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="paging_custom">
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
    $(document).on('change', '.remix-run-batch', function () {
        var returnVal = confirm("Are you sure?");
        if($(this).is(":checked")) {
            $(this).prop("checked", returnVal);
        }else{
            $(this).prop("checked", !returnVal);
        }
    })
</script>
@endsection
