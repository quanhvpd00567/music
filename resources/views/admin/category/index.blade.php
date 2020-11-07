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
        <div class="col-lg-12 no-padding p-t-10">
            <div class="card card-transparent">
                <div class="card-body no-padding">
                    <div id="card-advance" class="card card-default">
                        <div class="card-header">
                            Total: {{count($categories)}} categories
                            <button type="button" class="btn btn-primary float-right" id="btn-category-new">Create new</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed" id="condensedTable">
                                    <thead>
                                    <tr>
                                        <th style="width:5%">No.</th>
                                        <th>Category Name</th>
                                        <th>Slug</th>
                                        <th>Total Song</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($categories) == 0)
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <h3>Data not found</h3>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($categories as $key => $category)
                                            <tr>
                                                <td class="v-align-middle semi-bold">{{ $key + 1 }}</td>
                                                <td class="v-align-middle">{{$category->name}}</td>
                                                <td class="v-align-middle"> {{$category->slug}}</td>
                                                <td>{{count($category->songs)}}</td>
                                                <td>{{$category->status}}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm btn-edit" data-id="{{$category->id}}"><i class="fa fa-edit"> Edit</i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade slide-up disable-scroll" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="modalSlideUpLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="modal-header clearfix text-left" style="border-bottom: 1px solid #cccccc; padding: 0 0 0 10px">
                            <h5>Create</h5>
                            <button type="button" class="small-text close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                        <div class="modal-body pt-3">
                            <form action="" id="form-category">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Category name</label>
                                            <input type="text" class="form-control" id="name-add">
                                            <span class="text-danger" id="error-name-add"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="text" class="form-control" id="image-add">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check primary">
                                                <input type="checkbox" id="status-add" checked>
                                                <label for="status-add">Status</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="btn-add" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-secondary close-modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div class="modal fade slide-up disable-scroll" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="modalSlideUpLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="modal-header clearfix text-left" style="border-bottom: 1px solid #cccccc; padding: 0 0 0 10px">
                            <h5>Edit</h5>
                            <button type="button" class="small-text close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                        <div class="modal-body pt-3">
                            <form action="" id="form-category">
                                <input type="hidden" class="form-control" id="id-edit">
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category name</label>
                                                <input type="text" class="form-control" id="name-edit">
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="text" class="form-control" id="image-edit">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check primary">
                                                    <input type="checkbox" id="status-edit" checked>
                                                    <label for="status-edit">Status</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" id="btn-update" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-secondary close-modal">Cancel</button>
                                            </div>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('#btn-category-new').on('click', function () {
                $('#createCategory').modal('show');
            })

            $('.close-modal').on('click', function () {
                $('#createCategory').modal('hide');
                $('#editCategory').modal('hide');
                reset()
            })

            $('#btn-add').on('click', function (e) {
                e.preventDefault();

                let data = {
                    "_token": "{{ csrf_token() }}",
                    status: $('#status-add').is(":checked"),
                    image: $('#image-add').is(":checked"),
                    name: $('#name-add').val()
                }

                $.ajax({
                    url: '{{route('category.create')}}',
                    method: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.status) {
                            location.reload()
                        }
                    },
                    error: function (error) {
                        if(error.status === 422) {
                            $('#error-name-add').text(error.responseJSON.errors.name[0]).show()
                        }else {
                            alert('Error Serve')
                        }

                    }
                })

            })

            $('#btn-update').on('click', function (e) {
                e.preventDefault();

                let data = {
                    "_token": "{{ csrf_token() }}",
                    status: $('#status-edit').is(":checked"),
                    name: $('#name-edit').val(),
                    image: $('#image-edit').val(),
                    id: $('#id-edit').val()
                }

                $.ajax({
                    url: '{{route('category.update')}}',
                    method: 'PUT',
                    data: data,
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.status) {
                            location.reload()
                        }
                    },
                    error: function (error) {
                        if(error.status === 422) {
                            console.log(error)
                            $('#error-name-edit').text(error.responseJSON.errors.name[0]).show()
                        }else {
                            alert('Error Serve')
                        }
                    }
                })

            })

            $('.btn-edit').on('click', function (e) {
                e.preventDefault()
                let id = $(this).attr('data-id')
                let url = '{{route('category.edit', ['id' => 'viewtmix_key_id'])}}'
                url = url.replace("viewtmix_key_id", id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.status) {
                            $('#editCategory').modal('show');
                            setDataEdit(res.data)
                        }
                    }
                })
            })

            function reset() {
                $('#error-name-add').hide()
                $('#error-name-edit').hide()
                $('#form-category').trigger("reset");
            }

            function setDataEdit(object) {
                $('#name-edit').val(object.name)
                $('#id-edit').val(object.id)
                $('#image-edit').val(object.image)
                $('#status-edit').prop('checked', object.status)
            }
        })
    </script>
@endsection
