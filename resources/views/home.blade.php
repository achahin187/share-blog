@extends('layouts.master')
@section('title')
    <title>home</title>

@endsection
@section('small-title')
    <ul class="breadcrumb">
        <li><a href="/home"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
        <li><a href="/home">{{ __('messages.Home') }}</a><i class="icon-angle-right"></i></li>
    </ul>
@endsection
@section('content')

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span8">
                    @foreach ($posts as $post)

                        <article>
                            <div class="row">
                                <div class="span8">
                                    <div class="post-image">
                                        <div class="post-heading">
                                            @if (Auth::check())

                                                @if (Auth::user()->name == $post->user->name)
                                                    <h3><a href="{{ route('profile.index') }}">{{ $post->user->name }}</a>
                                                    </h3>

                                                @else
                                                    <h3><a
                                                            href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                                    </h3>

                                                @endif
                                            @else
                                                <h3><a href="#">{{ $post->user->name }}</a></h3>

                                            @endif

                                        </div>
                                        <img src="/uploades/{{ $post->image }}" alt="" />
                                    </div>
                                    <p>
                                        {{ $post->post }}
                                    </p>
                                    <div class="bottom-article">
                                        <ul class="meta-post">
                                            <li><i class="icon-calendar"></i><a
                                                    href="#">{{ $post->created_at->diffForHumans() }}</a></li>
                                            @if (Auth::check())
                                                @if (Auth::user()->name == $post->user->name)
                                                    <li><i class="icon-user"></i><a
                                                            href="{{ route('profile.index') }}">{{ $post->user->name }}</a>
                                                    </li>

                                                @else
                                                    <li><i class="icon-user"></i><a
                                                            href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                                    </li>

                                                @endif


                                            @else
                                                <li><i class="icon-user"></i><a href="#">{{ $post->user->name }}</a></li>


                                            @endif
                                            <li><i class="icon-folder-open"></i><a href="#"> {{ $post->category->name }}</a>
                                            </li>
                                            <li><i class="icon-comments"></i><a href="#">


                                                    {{ $comments->count() }}



                                                    Comments</a></li>
                                            <li>
                                                <form method="POST" action="" id="favoriteForm">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="hidden" value="{{ $post->id }}" name="post_id"
                                                        id="post_id">

                                                    <a id="fav" style="cursor: pointer"> <i class="fa fa-heart"></i> </a>
                                                </form>
                                            </li>
                                        </ul>
                                        <a href="{{ route('post.show', $post->id) }}" class="pull-right">Continue reading <i
                                                class="icon-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach







                    <div class="pagination">
                        {{ $posts->links() }}

                    </div>
                </div>
                <div class="span4">
                    <aside class="right-sidebar">
                        <div class="widget">
                            <form class="form-search">
                                <input placeholder="Type something" type="text" class="input-medium search-query">
                                <button type="submit" class="btn btn-square btn-theme">{{ __('messages.Search') }}</button>
                            </form>
                        </div>
                        <div class="widget">
                            <h5 class="widgetheading">Categories</h5>
                            <ul class="cat">
                                @foreach ($categories as $category)
                                    <li><i class="icon-angle-right"></i><a href="#">{{ $category->name }}</a><span> <span>
                                    </li>

                                @endforeach

                            </ul>
                        </div>
                        <div class="widget">
                            <h5 class="widgetheading">Latest posts</h5>
                            <ul class="recent">
                                @foreach ($posts2 as $post)

                                    <li>
                                        <img src="/uploades/{{ $post->image }}" class="pull-left" alt=""
                                            style="width: 60px" />
                                        <h6><a href="#">{{ $post->user->name }}</a></h6>
                                        <p>
                                            {{ substr(strip_tags($post->post), 0, 50) }}

                                            @if (strlen(strip_tags($post->post)) > 50)

                                                <a href='{{ route('post.show', $post->id) }}'
                                                    class='read-more'>...ReadMore</a>


                                            @endif
                                        </p>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="widget">
                            <h5 class="widgetheading">Popular tags</h5>
                            <ul class="tags">
                                <li><a href="#">Web design</a></li>
                                <li><a href="#">Trends</a></li>
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Internet</a></li>
                                <li><a href="#">Tutorial</a></li>
                                <li><a href="#">Development</a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $('#fav').click(function() {
                $(this).css('color', 'red');
            });

            var favoriteForm = $('#favoriteForm');
            $('#fav').on('click', function(e) {
                e.preventDefault();
                var formData = favoriteForm.serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('favorite.store') }}",
                    data: formData,
                    dataType: "json",
                    success: function(data) {

                        toastr.success('Post Added To Favorite List');




                    },
                    error: function(reject) {



                    }


                });



            });

        });

    </script>


@endsection
