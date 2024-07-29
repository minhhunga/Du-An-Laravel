@extends('Frontend.layout.master')
@section('content')
    <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
                        <div class="single-blog-post">
                            <h3>{{ $blog->Title }}</h3>
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-user"></i> Mac Doe</li>
                                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                </ul>
                                <!-- <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </span> -->
                            </div>
                            <a href="">
                                <img src="{{ asset($blog->Image) }}" alt="">
                            </a>
                            <p>{{$blog->Description}}</p> <br>

                            <div class="pager-area">
                                <ul class="pager pull-right">
                                     @if ($previousBlog)
                                        <li><a href="{{ route('blog.show', ['id' => $previousBlog->id]) }}">Pre</a></li>
                                    @endif

                                     @if ($nextBlog)
                                        <li><a href="{{ route('blog.show', ['id' => $nextBlog->id]) }}">Next</a></li>
                                     @endif
                                </ul>
                            </div>
                        </div>
                    </div><!--/blog-post-area-->

                    <div class="rating-area">
                        <ul class="ratings">
                            <li class="rate-this">Rate this item:</li>
                            <div class="rate">
                                <div class="vote">
                                    <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                    <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                    <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                    <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                    <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                    <span class="rate-np">{{ round($tbc, 1) }}</span>
                                </div> 
                            </div>
                            
                            <li class="color">(6 votes)</li>
                        </ul>
                        <ul class="tag">
                            <li>TAG:</li>
                            <li><a class="color" href="">Pink <span>/</span></a></li>
                            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                            <li><a class="color" href="">Girls</a></li>
                        </ul>
                    </div><!--/rating-area-->

                    <div class="socials-share">
                        <a href=""><img src="images/blog/socials.png" alt=""></a>
                    </div><!--/socials-share-->

                    <!-- <div class="media commnets">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="images/blog/man-one.jpg" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Annie Davis</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <div class="blog-socials">
                                <ul>
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                                <a class="btn btn-primary" href="">Other Posts</a>
                            </div>
                        </div>
                    </div> --><!--Comments-->
                   <div class="response-area">
    <h2> RESPONSES</h2>
    <ul class="media-list">
        @foreach($comments as $item1)
            @if ($item1->level == 0)
                <!-- Li cha -->
                <li class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="images/blog/man-two.jpg" alt="">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{ $item1->name }}</li>
                            <li><i class="fa fa-clock-o"></i>{{ $item1->created_at }}</li>
                            <li><i class="fa fa-calendar"></i>{{ $item1->created_at }}</li>
                        </ul>
                        <p>{{ $item1->cmt }}</p>
                        <a class="btn btn-primary reply" id="{{ $item1->id }}" href=""><i class="fa fa-reply"></i>Replay</a>

                        <!-- Vòng lặp để hiển thị các bình luận con -->
                        <ul class="media-list">
                            @foreach($comments as $item2)
                                @if ($item2->level == $item1->id)
                                    <!-- Li con -->
                                    <li class="media second-media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="images/blog/man-three.jpg" alt="">
                                        </a>
                                        <div class="media-body">
                                            <ul class="sinlge-post-meta">
                                                <li><i class="fa fa-user"></i>{{ $item2->name }}</li>
                                                <li><i class="fa fa-clock-o"></i>{{ $item2->created_at }}</li>
                                                <li><i class="fa fa-calendar"></i>{{ $item2->created_at }}</li>
                                            </ul>
                                            <p>{{ $item2->cmt }}</p>
                                            <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</div><!--/Response-area-->

                    <div class="replay-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Leave a replay</h2>
                                
                                <div class="text-area">
                                    <div class="blank-arrow">
                                        <label>Your Name</label>
                                    </div>
                                    <form class="comment" method="POST" action="{{ route('blog.cmt') }}">
                                    @csrf
                                    <span>*</span>
                                    
                                    <textarea name="cmt" rows="11"></textarea>
                                    <input type="hidden" name="id_blog" value="{{ $blog->id }}">
                                    <input type="hidden" name="level" value=0  id="">
                                    
                                    <button type="submit">Post Comment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!--/Repaly Box-->
                </div>

    <script>

        $(document).ready(function(){

            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //vote
            $('.ratings_stars').hover(
                // Handles the mouseover
                function() {
                    $(this).prevAll().andSelf().addClass('ratings_hover');
                    // $(this).nextAll().removeClass('ratings_vote'); 
                },
                function() {
                    $(this).prevAll().andSelf().removeClass('ratings_hover');
                    // set_votes($(this).parent());
                }
            );

            $('.ratings_stars').click(function(){
                var checkLogin = "{{Auth::Check()}}";
                

                if(checkLogin){
                var rate =  $(this).find("input").val();
                alert(rate);

                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    } else {
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    }

                    $.ajax({
                           type:'POST',
                           url:'{{ route('blog.rate') }}',
                           data:{
                            rate:rate,
                            id_blog:"{{ $blog->id }}"
                            },
                           success:function(data){
                              console.log(data.success);
                           }
                        });


                }else{
                    alert("vui long login de rate");
                }
            });

            $("form.comment").submit(function() {
                var checkLogin = "{{ Auth::check() }}";
                if (checkLogin) { //check login
                    var comment = $('textarea').val(); //lấy cmt
                    if (comment != "") { 
                        //alert("123");
                        var level = $(this).attr("id"); //lấy id cha
                        $.ajax({ // gọi ajax gửi form POst
                            type: 'POST',
                            url: "{{ route('blog.cmt') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                cmt: cmt,
                                id_blog: "{{ $blog['id'] }}",
                                id_user: "{{ Auth::id() }}",
                                level: level
                            },
                            success: function(data) {
                                console.log(data);
                            }
                        });
                    } else {
                        alert("Vui Lòng Nhập Bình Luận");
                        return false;
                    }

                } else {
                    alert("Vui Lòng Đăng NHập ! ");
                }
            });
            $(".reply").addClass(function(){
                var xx=$(this).attr("id");
                alert(xx)
                $("input[name='level']").val(xx);
            })

        });
    </script>
@endsection