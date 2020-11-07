<section class="contact-wrap search">
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            {{Form::open(['route' => 'search', 'method' => 'GET'])}}
            <div class="input-group">
                {{Form::text('keyword', request()->get('keyword'), ['class' => 'form-control', 'placeholder' => 'Tìm kiếm bài hát ...'])}}
                <span class="input-group-btn">
                  <button class="btn" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
            </div>
            {{Form::close()}}
        </div>
    </div>
</section>
