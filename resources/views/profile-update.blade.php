@extends('layouts.master')
@section('title')
<title>profile</title>

@endsection
@section('small-title')
<ul class="breadcrumb">
  <li><a href="/home"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
  <li><a href="{{ route('profile.edit',Auth::user()->id)}}">profile-setings</a><i class="icon-angle-right"></i></li>
</ul>
@endsection
@section('content')
<!------------------------->
<section id="content">
    <div class="container">
      <div class="row">
        <div class="span8">
            <h4>Profile Setting</h4>
            
          <form class="right-sidebar" action="{{ route('profile.update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf

            <div class="widget">
              <h5 class="widgetheading">

                <label class="btn btn-file">
                    <img src="/img/avatar.png" alt='Avatar' class='avatar'  style="height: 80px">
                    <input type="file" name="image" />
                </label>

              </h5>
            
              <ul class="folio-detail">
                <li><label>City: </label><input type="text" name="city" value="{{ $user->city }}" ></li>

                <li><label>JopTitle: </label><input type="text" name="jobtitle" value="{{ $user->joptitle }}" ></li>

        
              </ul>
            </div>
            <div class="widget">
              <h5 class="widgetheading">Bio:</h5>
              <textarea id="form10" class="md-textarea form-control"
              rows="3" name="bio" placeholder="write in your mind now" > {{ $user->bio }}</textarea>
            </div>
            <button class="btn btn-sm btn-dark" type="submit">Update</button>
          </form>
        </div>
      </div>
    </div>
  </section>



<!----------------------------------------------------------------------->
@endsection
















 