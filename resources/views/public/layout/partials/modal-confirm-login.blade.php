<div class="modal fade" id="popupConfirmUpload" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bạn chưa đăng nhập</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Bạn phải đăng nhập mới có thể đăng bài hát</p>
                    </div>
                    <div class="col-md-12" style="padding-top: 10px">
                        <a href="{{route('login')}}" class="btn btn-primary btn-login">Đăng nhập</a>
                        <a class="btn facebook-btn btn-block" style="color: white; background-color: #1877f2" href="{{route('socialite_login', ['provider' => 'facebook'])}}" >
                            <i class="fa fa-facebook"></i> Login with facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
