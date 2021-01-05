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
            
          <form class="right-sidebar" action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
            @method('POST')
            <input type="hidden" name="method" value="POST">
            @csrf

            <div class="widget">
              <h5 class="widgetheading">

                <label class="btn btn-file">
                    <img src="/img/avatar.png" alt='Avatar' class='avatar'  style="height: 80px">
                    <input type="file" name="image" />
              
                </label>

              </h5>
            
              <ul class="folio-detail">
                <li><label>City: </label><input type="text" name="city">
             
                
                </li>

                <li><label>JopTitle: </label><input type="text" name="joptitle">
                
               
                </li>

        
              </ul>
            </div>
            <div class="widget">
              <h5 class="widgetheading">Bio:</h5>
              <textarea id="form10" class="md-textarea form-control"
              rows="3" name="bio" placeholder="write in your mind now" ></textarea>
           
            </div>
            <button class="btn btn-sm btn-dark" type="submit">Save</button>
          </form>
        </div>
      </div>
    </div>
  </section>



<!----------------------------------------------------------------------->
@endsection
















 