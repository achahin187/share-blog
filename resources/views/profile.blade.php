@extends('layouts.master')
@section('title')
    <title>profile</title>

@endsection
@section('small-title')
    <ul class="breadcrumb">
        <li><a href="/home"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>

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
                                                                <h3><a
                                                                        href="{{ route('profile.index') }}">{{ $post->user->name }}</a>
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
                                                                href="#">{{ $post->created_at->format('d/m/Y') }}</a></li>
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
                                                            <li><i class="icon-user"></i><a
                                                                    href="#">{{ $post->user->name }}</a></li>

                                                        @endif
                                                        <li><i class="icon-folder-open"></i><a href="#">
                                                                {{ $post->category->name }}</a>
                                                        </li>
                                                        <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                                                    </ul>
                                                    <a href="{{ route('post.show', $post->id) }}" class="pull-right">Continue
                                                        reading <i class="icon-angle-right"></i></a>
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
                                            <input placeholder="Type something" type="text"
                                                class="input-medium search-query">
                                            <button type="submit"
                                                class="btn btn-square btn-theme">{{ __('messages.Search') }}</button>
                                        </form>
                                    </div>


                                    <div class="widget">
                                        <h5 class="widgetheading">Latest Favorite</h5>
                                        <ul class="recent">
                                            @foreach ($favorites as $favorite)

                                                <li>
                                                    <img src="/uploades/{{ $favorite->post->image }}" class="pull-left"
                                                        alt="" style="width: 60px" />
                                                    <h6><a href="#">{{ $favorite->post->user->name }}</a></h6>
                                                    <p>
                                                        {{ substr(strip_tags($favorite->post->post), 0, 50) }}

                                                        @if (strlen(strip_tags($favorite->post->post)) > 50)

                                                            <a href='{{ route('post.show', $post->id) }}'
                                                                class='read-more'>...ReadMore</a>


                                                        @endif
                                                    </p>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>

                                </aside>
                            </div>

                        </div>

                </div>
            </div>
    </section>

@endsection
