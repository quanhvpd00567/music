{{ Form::model($song, ['url' => $url, 'enctype' => 'multipart/form-data'] ) }}
{{Form::hidden('mode', $song->id ? true : false)}}
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Title Song</label>
            {{Form::text('title', $song->title, ['class' => 'form-control', 'id' => 'title'])}}
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Category</label>
            {{Form::select('category_id', $listCategories, $song->category_id, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            <label>Author</label>
            {{Form::text('author', $song->author, ['class' => 'form-control', 'id' => 'author'])}}
            @error('author')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Link audio</label>
            {{Form::text('file_name', $song->file_name,
                    ['class' => 'form-control',
                    'id' => 'file_name',
                    'placeholder' => 'vietmix/nhac-hay.mp3'
                    ])}}
            @error('file_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="x">File image</label>
            {{Form::hidden('image_hidden', $song->image)}}
            {{Form::file('image', ['class' => 'form-control', 'id' => 'image', 'accept' =>"image/png, image/jpeg, 'image/jpg"])}}
            @if($song->id)
                @error('image_hidden')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            @else
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            @endif
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>View</label>
                {{Form::number('view', $song->view, ['class' => 'form-control', 'id' => 'view'])}}
                @error('view')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label>Liked</label>
                {{Form::number('liked', $song->liked, ['class' => 'form-control', 'id' => 'liked'])}}
                @error('liked')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Image view</label>
            <img id="img-preview" style="width: 100%; height: 300px; border: 1px solid #cccccc" src="{{$song->image ?? '/images/no-image.png'}}" alt="">
        </div>
    </div>
</div>
{{ Form::close() }}


@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert('select a file to see preview');
                $('#previewHolder').attr('src', '');
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
@endsection
