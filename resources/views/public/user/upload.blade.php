@extends('public.layout.master')
@section('metas')
    @include('public.layout.partials.meta-default')
@endsection
@section('content')
    <section class="contact-wrap">
        <div class="container">
            <div class="col-md-8 left">
                <div class="title top-title">
                </div>
                <div class="title text-center">
                    <h2>Đăng bài hát</h2>
                </div>
                <div class="col-md-8">
                {{ Form::model($song, ['router' => 'upload.post', 'enctype' => 'multipart/form-data', 'id' => 'userUpload'] ) }}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="usr">Tên bài hát:</label>
                            {{Form::text('title', $song->title,
                                            ['class' => "form-control", 'placeholder' => 'Vd: Buồn của anh remix'])}}
                            @error('title')
                            <span class="text-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label>Loại</label>
                            {{Form::select('category_id', $listCategories, $song->category_id, ['class' => 'form-control'])}}
                        </div>
                        <div class="col-md-12">
                            <label for="pwd">Hình ảnh:</label>
                            {{Form::file('image', ['class' => "form-control", 'id' => 'image_upload', 'accept' =>"image/png, image/jpeg, 'image/jpg"])}}
                            @error('image')
                            <span class="text-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="pwd">Hình nhạc:</label>
                            {{Form::file('file', ['class' => "form-control", 'accept' =>"audio/mp3, audio/mpeg, 'audio/mpga,'audio/wav"])}}
                            @error('file')
                            <span class="text-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="pwd">Người trình bày:</label>
                            {{Form::text('author', $song->author,
                                            ['class' => "form-control", 'placeholder' => 'Vd: DJ Sơn'])}}
                            @error('author')
                            <span class="text-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="pwd">Thể tag:</label>
                            {{Form::text('keyword', $song->keyword,
                                           ['class' => "form-control", 'placeholder' => 'Vd: remix, nonstop, vinahouse'])}}
                            @error('keyword')
                            <span class="text-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="description">Mô tả:</label>
                            {{Form::textarea('description', $song->description,
                                           ['class' => "form-control", 'rows' => 5 ,'placeholder' => 'Vd: Nghe nhạc chất lương.....'])}}

                        </div>
                        <div class="col-md-12" style="padding-top: 10px">
                            <input name="submit" style="width: 100%; margin-bottom: 20px" type="submit" class="def-button" value="Đăng ký">
                        </div>
                    </div>
                {{ Form::close() }}
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <img src="images/no-image.png" id="img_preview" style="border: 1px solid #ffffff; background: #fff" width="100%" height="200px" alt="">
                    </div>
                </div>

            </div><!--/.left -->
            <div class="col-md-4 right">
                <div>
                    <ul id="notes">
                        <li class="item">
                            <span class="text-left">Xin chào: <span class="text-danger">{{auth()->user()->name}}</span></span>
                            <h3 class="text-center">Quy tắc upload bài hát</h3>
                            <ul>
                                <li>1: Tên bài hát phải có nghĩa</li>
                                <li>2: Hình ảnh bài hát không quá  <span class="text-danger">3M</span></li>
                                <li>3: File nhạc phải lớn hơn
                                    <span class="text-danger">5M</span>
                                    và không quá
                                    <span class="text-danger">50M</span>
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
        </div><!-- /.container -->
    </section>
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

