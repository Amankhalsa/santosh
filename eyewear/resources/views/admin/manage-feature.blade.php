@extends('admin.layouts.app')

@section('title','Manage Feature')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Manage Feature &nbsp; <i style="font-size:20px;" class="fas fa-bookmark"></i></h4>

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

{{-- Admin Features START --}}

  <div class="col-lg-6 col-12">
  <form action="{{ route('update-admin-feature') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @method('PUT')

        <div class="card">
        <div class="card-header">
         <strong>Admin Features</strong>
        </div>
        <div class="card-body card-block">

<div class="row form-group">
    <div class="col-7">
        <label id="site-feature-label-text">Category Level : <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="You can only change the category level then, when any category is not exist in the table"></i></label>
    </div>
    <div class="col-5">
      @if($is_category_exist > 0) 
       <input type="text" name="admin_category_level" value="{{$admin_data->admin_category_level}}" class="form-control" readonly>
      @else
        <select name="admin_category_level" class="custom-select" >
            <option selected disabled>Select category level</option>
            <option value="0" @if($admin_data->admin_category_level == 0) selected @endif >Level 0 (product)</option>
            <option value="1" @if($admin_data->admin_category_level == 1) selected @endif >Level 1</option>
            <option value="2" @if($admin_data->admin_category_level == 2) selected @endif >Level 2</option>
            <option value="3" @if($admin_data->admin_category_level == 3) selected @endif >Level 3</option>
        </select>
      @endif  
    </div>
    </div>

{{-- ################################################################################## --}}

     <div class="row form-group">
      <div class="col-7">
        <label id="site-feature-label-text">Category Thumb :</label>
      </div>
      <div class="col-5">
       <div class="row">
        <div class="col-6 col-md-4">
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="customRadio" name="admin_cat_thumb" value="Yes" @if($admin_data->admin_cat_thumb == "Yes") checked  @endif>
            <label class="custom-control-label" for="customRadio">Yes</label>
          </div></div>
        <div class="col-6 col-md-4">
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="customRadio1" name="admin_cat_thumb" value="No" @if($admin_data->admin_cat_thumb == "No") checked  @endif>
            <label class="custom-control-label" for="customRadio1">No</label>
          </div></div>
      </div>
      </div>
    </div>

{{-- ################################################################################## --}}

<div class="row form-group">
    <div class="col-7">
      <label id="site-feature-label-text">Sub Category Thumb :</label>
    </div>
    <div class="col-5">
     <div class="row">
      <div class="col-6 col-md-4">
      <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="customRadio3" name="admin_subcat_thumb" value="Yes" @if($admin_data->admin_subcat_thumb == "Yes") checked  @endif>
          <label class="custom-control-label" for="customRadio3">Yes</label>
        </div></div>
      <div class="col-6 col-md-4">
        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="customRadio4" name="admin_subcat_thumb" value="No" @if($admin_data->admin_subcat_thumb == "No") checked  @endif>
          <label class="custom-control-label" for="customRadio4">No</label>
        </div></div>
    </div>
    </div>
</div>

{{-- ################################################################################## --}}

<div class="row form-group">
    <div class="col-7">
      <label id="site-feature-label-text">Final Category Thumb :</label>
    </div>
    <div class="col-5">
     <div class="row">
      <div class="col-6 col-md-4">
      <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="customRadio5" name="admin_finalcat_thumb" value="Yes" @if($admin_data->admin_finalcat_thumb == "Yes") checked  @endif>
          <label class="custom-control-label" for="customRadio5">Yes</label>
        </div></div>
      <div class="col-6 col-md-4">
        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="customRadio6" name="admin_finalcat_thumb" value="No" @if($admin_data->admin_finalcat_thumb == "No") checked  @endif>
          <label class="custom-control-label" for="customRadio6">No</label>
        </div></div>
    </div>
    </div>
</div>

{{-- ################################################################################## --}}

<div class="row form-group">
    <div class="col-7">
      <label id="site-feature-label-text">Product Thumb :</label>
    </div>
    <div class="col-5">
     <div class="row">
      <div class="col-6 col-md-4">
      <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="customRadio7" name="admin_product_thumb" value="Yes" @if($admin_data->admin_product_thumb == "Yes") checked  @endif>
          <label class="custom-control-label" for="customRadio7">Yes</label>
        </div></div>
      <div class="col-6 col-md-4">
        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="customRadio8" name="admin_product_thumb" value="No" @if($admin_data->admin_product_thumb == "No") checked  @endif>
          <label class="custom-control-label" for="customRadio8">No</label>
        </div></div>
    </div>
    </div>
</div>

{{-- ################################################################################## --}}

<div class="row form-group">
    <div class="col-7">
      <label id="site-feature-label-text">Category Search Option :</label>
    </div>
    <div class="col-5">
     <div class="row">
      <div class="col-6 col-md-4">
      <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="customRadio9" name="admin_search_option" value="Yes" @if($admin_data->admin_search_option == "Yes") checked  @endif>
          <label class="custom-control-label" for="customRadio9">Yes</label>
        </div></div>
      <div class="col-6 col-md-4">
        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="customRadio10" name="admin_search_option" value="No" @if($admin_data->admin_search_option == "No") checked  @endif>
          <label class="custom-control-label" for="customRadio10">No</label>
        </div></div>
    </div>
    </div>
</div>



        </div>
        <div class="card-footer" style="box-shadow:2px 2px 2px grey;">

 <div class="row">

  <div class="col-12">
    <button type="submit" class="btn btn-primary btn-md">
    <i class="fa fa-send"></i> Submit
    </button>
 </div>
</div>
        </div>
        </div>
</form>
</div>

{{-- Admin Features END --}}

{{-- Site Features START --}}

<div class="col-lg-6 col-12">
    <form action="{{ route('update-site-feature') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
    @csrf
    @method('PUT')

          <div class="card">
          <div class="card-header">
           <strong>Site Features & SEO</strong>
          </div>
          <div class="card-body card-block">

  <div class="row form-group">
      <div class="col-7">
        <label id="site-feature-label-text">Automatic Backup :</label>
      </div>
      <div class="col-5">
       <div class="row">
        <div class="col-12 col-md-12">
          <input id="toggle-backup" name="backup_option_toggle" class="backup_option_toggle" type="checkbox" @if($admin_data->admin_backup_option == "Yes") checked @else @endif>
          <input type="hidden" name="admin_backup_option" id="admin_backup_option" @if($admin_data->admin_backup_option == "Yes") value="Yes" @else value="No" @endif>

          </div>

      </div>
      </div>
  </div>

<div id="backup_schedule" @if($admin_data->admin_backup_option == "No") style="display:none" @endif>
<div class="row form-group">
    <div class="col-7">
      <label id="site-feature-label-text">Backup Schedule :</label>
    </div>
    <div class="col-5">
     <div class="row">
      <div class="col-12 col-md-12">
        <select name="admin_backup_schedule" class="custom-select">
            <option selected disabled>Select backup schedule</option>
            <option value="daily" @if($admin_data->admin_backup_schedule == "daily") selected @endif>daily</option>
            <option value="weekly" @if($admin_data->admin_backup_schedule == "weekly") selected @endif>weekly</option>
            <option value="monthly" @if($admin_data->admin_backup_schedule == "monthly") selected @endif>monthly</option>
        </select>
      </div>

    </div>
    </div>
</div>
</div>

{{-- ***************##################################################********************* --}}

<div class="row form-group">
    <div class="col-7">
      <label id="site-feature-label-text">Automatic site map generation :</label>
    </div>
    <div class="col-5">
     <div class="row">
      <div class="col-12 col-md-12">
        <input id="toggle-sitemap" name="sitemap_option_toggle" class="sitemap_option_toggle" type="checkbox" @if($admin_data->admin_sitemap_option == "Yes") checked @else @endif>
        <input type="hidden" name="admin_sitemap_option" id="admin_sitemap_option" @if($admin_data->admin_sitemap_option == "Yes") value="Yes" @else value="No" @endif>

        </div>

    </div>
    </div>
</div>

<div id="sitemap_schedule" @if($admin_data->admin_sitemap_option == "No") style="display:none" @endif>
<div class="row form-group">
  <div class="col-7">
    <label id="site-feature-label-text">Site map Schedule :</label>
  </div>
  <div class="col-5">
   <div class="row">
    <div class="col-12 col-md-12">
      <select name="admin_sitemap_schedule" class="custom-select">
          <option selected disabled>Select sitemap schedule</option>
          <option value="daily" @if($admin_data->admin_sitemap_schedule == "daily") selected @endif>daily</option>
          <option value="weekly" @if($admin_data->admin_sitemap_schedule == "weekly") selected @endif>weekly</option>
          <option value="monthly" @if($admin_data->admin_sitemap_schedule == "monthly") selected @endif>monthly</option>
      </select>
    </div>

  </div>
  </div>
</div>
</div>

{{-- *******####################################################################************ --}}

<div class="row form-group">
    <div class="col-7">
      <label id="site-feature-label-text">Meta robots : <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="check this box for 'index, follow' "></i></label>
    </div>
    <div class="col-5">
     <div class="row">
      <div class="col-12 col-md-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck" name="admin_meta_robots" value="Yes" @if($admin_data->admin_meta_robots == "Yes") checked @endif>
            <label class="custom-control-label" for="customCheck">&nbsp;</label>
          </div>
      </div>

    </div>
    </div>
  </div>

          </div>
          <div class="card-footer" style="box-shadow:2px 2px 2px grey;">

   <div class="row">

    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-md">
      <i class="fa fa-send"></i> Submit
      </button>
   </div>
  </div>
          </div>
          </div>
  </form>
      </div>

{{-- Site Features END  --}}
  </div>
 </div>

 <!-- ******************** -->
</div>

@endsection
