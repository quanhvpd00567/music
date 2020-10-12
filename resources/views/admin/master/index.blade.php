@extends('admin.layouts.application')

@section('content')

    <div data-pages="parallax">
        <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner">
                <div class="row" style="padding-left: 10px">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Website clone</li>
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
                                        <th style="width:15%">
                                            Name
                                            <i class="fa fa-question-circle-o text-danger"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title="Click name redirect to category list">
                                            </i>
                                        </th>
                                        <th>Link Site</th>
                                        <th>Status</th>
                                        <th>Run batch</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($sites) == 0)
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <h3>Data not found</h3>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($sites as $key => $site)
                                            <tr>
                                                <td class="v-align-middle semi-bold">{{$key + 1}}</td>
                                                <td class="v-align-middle">
                                                    <a href="{{ route('admin.master.category_list', ['id' => $site->id] )}}">
                                                        {{$site->name}}
                                                    </a>
                                                    <span class="badge badge-success">{{count($site->masterCategories)}}</span>
                                                </td>
                                                <td class="v-align-middle">
                                                    <a href="{{$site->website}}" target="_blank" class="text-link">
                                                        {{$site->website}}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($site->status == \App\Models\MasterSite::$status['clone'])
                                                        <span class="label label-success">Active</span>
                                                    @else
                                                        <span class="label label-important">Not Active</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-inline switch">
                                                        <input type="checkbox" class="remix-run-batch"
                                                               id="{{'pagesSwitch' . $site->id}}"
                                                               data-id="{{$site->id}}"
                                                            {{$site->is_run_batch == \App\Models\MasterSite::$batch['run'] ? 'checked' : ''}}>
                                                        <label for="{{'pagesSwitch' . $site->id}}">
                                                            {{$site->is_run_batch == \App\Models\MasterSite::$batch['run'] ? 'Running' : 'Stopped' }}
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="">
                                                        <i class="fa fa-edit">  Edit</i>
                                                    </a>
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
            let id = $(this).attr('data-id');
            let returnVal = confirm("Are you sure?");
            if ($(this).is(":checked")) {
                onChangeUsingBatch(id, true)
            } else {
                onChangeUsingBatch(id, false)
            }
        })

        function onChangeUsingBatch(id, isUseBatch) {
            $.ajax({
                method: 'POST',
                url: '{{route('admin.master.change_status_batch')}}',
                data: {
                    id: id,
                    is_use_batch: isUseBatch,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    $('#pagesSwitch' + id).prop("checked", isUseBatch);
                    let options = {
                        'message': data.message,
                        'position': 'top-right',
                        'type': 'success',
                    }
                    showNotification(options)
                    location.reload()
                }
            })
        }

    </script>
@endsection
