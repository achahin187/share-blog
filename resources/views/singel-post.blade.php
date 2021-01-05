@extends('layouts.master')
@section('title')
    <title>Post</title>

@endsection
@section('small-title')
    <ul class="breadcrumb">
        <li><a href="/home"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
        <li><a href="/about">about</a><i class="icon-angle-right"></i></li>
    </ul>
@endsection
@section('content')


    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <h2>
                        @if (Auth::check())
                            @if (Auth::user()->name == $post->user->name)
                                <a  href="{{ route('profile.index') }}">{{ $post->user->name }}</a>
                              

                            @else
                                <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>
                               

                            @endif


                        @else
                            <a href="#">{{ $post->user->name }}</a>

                        @endif




                        /<small>{{ $post->category->name }}</small>
                    </h2>
                    <p>
                        {{ $post->post }}
                    </p>

                    <!-- end divider -->
                    <div class="row">
                        <div class="span6">
                            <h4> {{ __('messages.comments') }}
                                @if($comments->count() > 0)
                                 (<span id="count"> {{ $comments->count() }} </span>) 
                                @endif
                                
                                <i class="icon-comments"></i></h4>
                            <div class="accordion" id="accordion2">
                                @if(Auth::check())
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                            href="#collapseOne">
                                           {{ __('messages.write comment') }} </a>
                                    </div>
                                    <div id="collapseOne" class="accordion-body collapse in">
                                        <div class="accordion-inner">
                                            <div class="form-outline">
                                                <form method="POST" action="" id="commentForm">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="hidden" value="{{ $post->id }}" name="post_id" id="post_id">

                  <textarea class="form-control" id="comment" rows="" placeholder="write comment" name="comment"></textarea>
                  <button class="btn btn-sm btn-dark" style="border-radius: 10px;margin-left:20px" id="save" >{{ __('messages.send') }}</button>
                                           </form>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @foreach ($comments as $comment)
                                    
                                
                                <div class="accordion-group" id="showComment">
                                    <div class="accordion-heading">
                                       

                                         @if (Auth::check())
                                         @if (Auth::user()->name == $comment->user->name)
                                             <a  class="accordion" href="{{ route('profile.index') }}" id="username"> {{ $comment->user->name }} </a>
                                           
             
                                         @else
                                             <a  class="accordion"  id="username"  href="{{ route('profile.show', $post->user->id) }}"> {{ $comment->user->name }} </a>
                                            
             
                                         @endif
             
             
                                     @else
                                         <a   class="accordion"   id="username" href="#"> {{ $comment->user->name }} </a>
             
                                     @endif
                                         <small style="padding-left:10px" id="time">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div id="collapseTwo" class="accordion-body">
                                        <div class="accordion-inner">
                                            <p id="comment" value="{{ $comment->comment }}">
                                           {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                               
                           
                          
                            </div>
                        </div>

                    </div>
                </div>
                <div class="span6">
                    <!-- start flexslider -->
                    <div>
                        <ul>
                            <img src="/uploades/{{ $post->image }}" alt="" />

                        </ul>
                    </div>
                    <!-- end flexslider -->
                </div>
            </div>

            <!-- end divider -->

            <!-- divider -->


        </div>
</section

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


<script>

$(document).ready(function () {
    setInterval(function() {
        $("#showComment").load(window.location.href + " #showComment");
        $("#count").load(window.location.href + " #count");
    },4000); // This will load data every 5 seconds
});
	$(function () {


        var  commentForm = $('#commentForm');
		$('#save').on('click', function (e) {
          e.preventDefault();
          var formData = commentForm.serialize();
           $.ajax({
           type:'POST',
           url:"{{ route('comment.store') }}",
           data:formData,
           dataType:"json",
           success:function(data){
               toastr.success('Comment Added');
               $('#commentForm')[0].reset();

           },error:function(reject){
   
           }
   
   
             });
           
   
   
       });

    });



</script>







@endsection
