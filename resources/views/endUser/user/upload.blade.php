@extends('endUser.layouts.application')
<?php
use Illuminate\Support\Facades\URL;
?>
@section('metas')
    @include('endUser.layouts.meta-default')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="inner-content">
            <div class="row" >
                <h2 class="text-center" style="color: #ffffff">Đăng bài hát yêu thích của bạn</h2>
                {{ Form::model($song, ['url' => '/upload-song', 'enctype' => 'multipart/form-data', 'id' => 'userUpload'] ) }}
                <div class="col-md-8" >
                    <div class="row">
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label for="usr">Tên bài hát:</label>
                                {{Form::text('title', $song->title,
                                                ['class' => "form-control", 'placeholder' => 'Vd: Buồn của anh remix'])}}
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                {{Form::select('category_id', $listCategories, $song->category_id, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                <label for="pwd">Hình ảnh:</label>
                                {{Form::file('image', ['class' => "form-control", 'id' => 'image_upload', 'accept' =>"image/png, image/jpeg, 'image/jpg"])}}
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pwd">Hình nhạc:</label>
                                {{Form::file('file', ['class' => "form-control", 'accept' =>"audio/mp3, audio/mpeg, 'audio/mpga,'audio/wav"])}}
                                @error('file')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pwd">Người trình bày:</label>
                                {{Form::text('author', $song->author,
                                                ['class' => "form-control", 'placeholder' => 'Vd: DJ Sơn'])}}
                                @error('author')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pwd">Thể tag:</label>
                                {{Form::text('keyword', $song->keyword,
                                               ['class' => "form-control", 'placeholder' => 'Vd: remix, nonstop, vinahouse'])}}
                                @error('keyword')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <img src="images/no-image.png" id="img_preview" style="border: 1px solid #ffffff; background: #fff" width="100%" height="350px" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Mô tả:</label>
                                {{Form::textarea('description', $song->description,
                                               ['class' => "form-control", 'rows' => 5 ,'placeholder' => 'Vd: Nghe nhạc chất lương.....'])}}

                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload"> Đăng bài</i></button>
                        </div>
                    </div>
                </div>
                {{Form::close()}}

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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#img_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert('Bạn chưa chọn hình ảnh');
                $('#img_preview').attr('src', 'images/no-image.png');
            }
        }

        $("#image_upload").change(function() {
            readURL(this);
        });
    </script>
@endsection
