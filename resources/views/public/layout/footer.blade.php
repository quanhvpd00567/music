
<!-- Footer Begin-->
<footer class="footer">
    <div class="container">
        <div class="col-md-4 col-sm-4 footer-row">
            <div class="title"><h4>Giới thiệu</h4></div>
            <div class="content">
                <div class="text">
                    <p>
                        Vietmix.vn cảm ơn các bạn khi đã lựa chọn chúng tôi để nghe nhạc remix mới nhất
                        với các thể loại
                        <span class="iconRequired">Remix</span>,
                        <span class="iconRequired">Nonstop</span>,
                        <span class="iconRequired">Nhạc edm</span>
                        <span class="iconRequired">Vinahouse</span>,
                        <span class="iconRequired">Electro House mix</span>,
                        <span class="iconRequired">Machup</span>
                        <span class="iconRequired">...</span>
                    </p>
                    <p>
                        Xin Chúc các bạn nghe nhạc vui vẻ!
                    </p>
                </div><!-- /.content -->
            </div><!-- /.text -->

            <div class="title"><h4>Liên hệ</h4></div>
            <div class="content">
                <div class="socmed-wrap">
                    <a href="https://fb.com/quanhvpd00567"><i class="fa fa-facebook"></i></a>
                    @if(false)
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                    <a href="#"><i class="fa fa-soundcloud"></i></a>
                    @endif
                </div><!-- /.socmed-wrap -->
            </div><!-- /.content -->
        </div><!-- /.footer-row -->
        <div class="col-md-4 col-sm-4 footer-row">
            <div class="title"><h4>Thể loại Remix</h4></div>
            <div class="content">
                <ul class="upcoming-event">
                    @foreach($categories as $category)
                    <li>
                        <div class="col-md-10 col-sm-10 col-xs-10 name">
                            <a href="#" class="buy">{{$category->name}}</a>
                        </div>
                    </li>
                    @endforeach
                </ul><!-- /.upcoming-event -->
            </div><!-- /.content -->
        </div><!-- /.footer-row -->
        <div class="col-md-4 col-sm-4 footer-row">
            @if(false)
            <div class="title"><h4>Instagram</h4></div>
            <div class="content">
                <div class="content footer-images">
                    <a class="fancybox" href="/vietmix/images/footer-image1.jpg" data-fancybox-group="gallery">
                        <div class="image"><img src="/vietmix/images/footer-image1.jpg" alt="footer image"></div>
                    </a>
                    <a class="fancybox" href="/vietmix/images/footer-image2.jpg" data-fancybox-group="gallery">
                        <div class="image"><img src="/vietmix/images/footer-image2.jpg" alt="footer image"></div>
                    </a>
                    <a class="fancybox" href="/vietmix/images/footer-image3.jpg" data-fancybox-group="gallery">
                        <div class="image"><img src="/vietmix/images/footer-image3.jpg" alt="footer image"></div>
                    </a>
                    <a class="fancybox" href="/vietmix/images/footer-image4.jpg" data-fancybox-group="gallery">
                        <div class="image"><img src="/vietmix/images/footer-image4.jpg" alt="footer image"></div>
                    </a>
                </div><!-- /.footer-images -->
            </div><!-- /.content -->
            @endif

            <div class="title"><h4>Tags</h4></div>
            <div class="content">
                <div class="tag-wrap">
                    <a href="#" class="tag">Remix</a>
                    <a href="#" class="tag">Nonstop</a>
                    <a href="#" class="tag">Mashup</a>
                    <a href="#" class="tag">viet remix</a>
                    <a href="#" class="tag">nhac edm</a>
                    <a href="#" class="tag">Vinahouse</a>
                    <a href="#" class="tag">DJ nonstop</a>
                    <a href="#" class="tag">vietmix.vn</a>
                    <a href="#" class="tag">Nhac sàn</a>
                    <a href="#" class="tag">Nhạc dj</a>
                </div><!-- /.tag-wrap -->
            </div><!-- /.content -->
        </div><!-- /.foooter-row -->
    </div><!-- /.container -->

</footer><!-- /.footer -->
<!-- Footer End-->

<section class="copyright">
    <div class="container">
        <p>&copy; Bản quyền thuộc về <a href="/">vietmix.vn</a></p>
    </div>
</section>
