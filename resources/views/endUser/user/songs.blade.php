@extends('endUser.layouts.application')
<?php
use Illuminate\Support\Facades\URL;
?>
@section('metas')
    @include('endUser.layouts.meta-default')
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="inner-content">
            <div class="row" >
                <h2 class="text-center" style="color: #ffffff">Danh sách bài hát của bạn</h2>
                <div class="col-md-8" >
                    <ul class="nav nav-tabs custom-nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tabPendingSongs">Đang chờ duyêt</a></li>
                        <li><a data-toggle="tab" href="#tabApprovedTable">Đã duyêt</a></li>
                        <li><a data-toggle="tab" href="#tabRejectSongs">Không duyệt</a></li>
                    </ul>
                    <div class="tab-content" style="background-color: #2b3947">
                        <div id="tabPendingSongs" class="tab-pane fade in active">
                            @include('endUser.user._tableSong', ['id' => 'pendingSongs', 'songs' => $pendingSongs])
                        </div>
                        <div id="tabApprovedTable" class="tab-pane fade">
                            @include('endUser.user._tableSong', ['id' => 'approvedTable', 'songs' => $approvedSongs])
                        </div>
                        <div id="tabRejectSongs" class="tab-pane fade">
                            @include('endUser.user._tableSong', ['id' => 'rejectSongs', 'songs' => $rejectSongs])
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div>
                        <ul id="notes">
                            <li class="item">
                                <span class="text-left">Xin chào: <span class="text-danger">{{auth()->user()->name}}</span></span>
                                <h3 class="text-center">Quy tắc upload bài hát</h3>
                                <ul>
                                    <li>1: Tên bài hát phải có nghĩa</li>
                                    <li>2: Hình ảnh bài hát không quá  <span class="text-danger">3M</span></li>
                                    <li>3: File nhạc phải lớn hơn <span class="text-danger">10M</span>
                                    </li>
                                    <li>4: Thẻ tag viết cách nhau bở dấu "<span class="text-danger">,</span>"
                                        <br>
                                        Ví dụ: Nonstop, remix
                                    </li>
                                </ul>
                                <p class="text-danger" style="padding-top: 20px">Những bài hát không đáp ứng đủ những quy tắc trên thì sẽ không được duyệt</p>
                                <p style="padding-top: 10px">Cảm ơn bạn đã ủng hộ <a href="vietmix.vn">vietmix.vn</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--//music-right-->
            <div class="clearfix"></div>
            <!-- /w3l-agile-its -->
        </div>
        <!--body wrapper start-->
    </div>

    <div class="clearfix"></div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"> </script>
    <script>
        $(function () {
            $(document).ready(function() {
                $('#approvedTable').DataTable();
                $('#pendingSongs').DataTable();
                $('#rejectSongs').DataTable();
            } );
        })
    </script>
@endsection
