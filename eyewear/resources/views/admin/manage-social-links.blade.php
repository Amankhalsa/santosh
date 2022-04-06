@extends('admin.layouts.app')

@section('title','Social Media Links')

@section('content')
<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left">Social Media Links &nbsp; <i style="font-size:20px;" class="fas fa-share-alt-square"></i></h4>
</div>
</div>
</div>
<div class="section__content section__content--p30">
<br>

@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Errors Occurred!</strong>
    <ul style="margin-left:25px;">
     @foreach($errors->all() as $error)
     <li>{{ $error }}</li>
     @endforeach
    </ul>
</div>  
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}  
</div>
@endif

 <div class="container-fluid">
  <div class="row">
  <div class="col-lg-12 ">
            <div class="card">
            <div class="card-header">Update Social Media Links</div>
            <div class="card-body">
            <div class="card-title">
            <h3 class="text-center title-2">Change Social Media Links</h3>
            </div>
            <hr>
            <form action="{{ route('social-media-links') }}" method="post" >
            @csrf
            @method('PUT')

        <div class="row">
         <div class="col-lg-6">
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="zmdi zmdi-facebook-box fac_icon" aria-hidden="true"></i>
                </span>
                </div>
            <input id="admin_facebook_link" name="admin_facebook_link" type="text" class="form-control" placeholder="Enter facebook link here" @if(!empty($social_media_links->admin_facebook_link)) value="{{ $social_media_links->admin_facebook_link }}" @else value="{{ old('admin_facebook_link') }}" @endif>
            </div>
         </div>  
         <div class="col-lg-6"> 
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="zmdi zmdi-twitter-box twi_icon" aria-hidden="true"></i>
                </span>
                </div>
            <input id="admin_twitter_link" name="admin_twitter_link" type="text" class="form-control" placeholder="Enter twitter link here" @if(!empty($social_media_links->admin_twitter_link)) value="{{ $social_media_links->admin_twitter_link }}" @else value="{{ old('admin_twitter_link') }}" @endif>
            </div>
        </div>
       </div> 

<br>
 
       <div class="row">
         <div class="col-lg-6">
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="zmdi zmdi-linkedin-box lin_icon" aria-hidden="true"></i>
                </span>
                </div>
            <input id="admin_linkedin_link" name="admin_linkedin_link" type="text" class="form-control" placeholder="Enter linkedin link here" @if(!empty($social_media_links->admin_linkedin_link)) value="{{ $social_media_links->admin_linkedin_link }}" @else value="{{ old('admin_linkedin_link') }}" @endif>
            </div>
         </div>  
         <div class="col-lg-6"> 
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="zmdi zmdi-instagram ins_icon" aria-hidden="true"></i>
                </span>
                </div>
            <input id="admin_instagram_link" name="admin_instagram_link" type="text" class="form-control" placeholder="Enter instagram link here" @if(!empty($social_media_links->admin_instagram_link)) value="{{ $social_media_links->admin_instagram_link }}" @else value="{{ old('admin_instagram_link') }}" @endif>
            </div>
        </div>
       </div> 

<br>
 
       <div class="row">
       {{--   <div class="col-lg-6">
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="zmdi zmdi-pinterest-box pin_icon" aria-hidden="true"></i>
                </span>
                </div>
            <input id="admin_pinterest_link" name="admin_pinterest_link" type="text" class="form-control" placeholder="Enter pinterest link here" @if(!empty($social_media_links->admin_pinterest_link)) value="{{ $social_media_links->admin_pinterest_link }}" @else value="{{ old('admin_pinterest_link') }}" @endif>
            </div>
         </div> --}}  
         <div class="col-lg-6"> 
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="zmdi zmdi-youtube-play you_icon" aria-hidden="true"></i>
                </span>
                </div>
            <input id="admin_youtube_link" name="admin_youtube_link" type="text" class="form-control" placeholder="Enter youtube link here" @if(!empty($social_media_links->admin_youtube_link)) value="{{ $social_media_links->admin_youtube_link }}" @else value="{{ old('admin_youtube_link') }}" @endif>
            </div>
        </div>
       </div> 

<br>

       {{-- <div class="row">
         <div class="col-lg-6">
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="zmdi zmdi-tumblr tum_icon" aria-hidden="true"></i>
                </span>
                </div>
            <input id="admin_tumblr_link" name="admin_tumblr_link" type="text" class="form-control" placeholder="Enter tumblr link here" @if(!empty($social_media_links->admin_tumblr_link)) value="{{ $social_media_links->admin_tumblr_link }}" @else value="{{ old('admin_tumblr_link') }}" @endif>
            </div>
         </div>  
         <div class="col-lg-6"> 
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="zmdi zmdi-vimeo vimeo_icon" aria-hidden="true"></i>
                </span>
                </div>
            <input id="admin_vimeo_link" name="admin_vimeo_link" type="text" class="form-control" placeholder="Enter vimeo link here" @if(!empty($social_media_links->admin_vimeo_link)) value="{{ $social_media_links->admin_vimeo_link }}" @else value="{{ old('admin_vimeo_link') }}" @endif>
            </div>
        </div>
       </div>  --}}       

<br>

            <div>
            <button id="payment-button" type="submit" class="btn btn-info">
            <i class="fa fa-send "></i>&nbsp;
            <span id="payment-button-amount">Update</span>
            </button>
            </div>
            </form>
            </div>
            </div>
            </div>
  </div>
 </div>

 <!-- ******************** -->
</div>

@endsection

