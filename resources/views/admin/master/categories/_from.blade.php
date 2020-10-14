<div class="table-responsive">
    {{ Form::model($category, ['url' => $url]) }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Path category clone</label>
                {{Form::text('category_clone', $category->category_clone, ['class' => 'form-control', 'id' => 'category_clone'])}}
                @error('category_clone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Category display</label>
                {{Form::select('category_id', $listCategories, $category->category_id, ['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{Form::checkbox('is_run_batch', 1,  $category->is_run_batch == 0 , ['id' => 'is_run_batch'])}}
                <label for="is_run_batch">Run batch</label>
            </div>

            <div class="form-group">
                <a href="{{route('admin.master.category_list', ['id' => $idWebsite])}}">
                    <i class="fa fa-backward"></i>
                    Back to list
                </a>
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
