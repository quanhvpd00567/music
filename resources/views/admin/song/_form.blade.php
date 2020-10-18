{{ Form::model($song, ['url' => $url, 'enctype' => 'multipart/form-data'] ) }}
<div class="row">
    <div class="col-md-6">
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
            <label for="x">File</label>
            {{Form::file('file', ['class' => 'form-control', 'id' => 'x'])}}
            @error('file')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Author</label>
            {{Form::text('author', $song->author, ['class' => 'form-control', 'id' => 'author'])}}
            @error('author')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
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
{{ Form::close() }}
