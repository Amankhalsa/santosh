@extends('admin.layouts.app')

@section('title','Dashboard')

@section('content')

<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="overview-wrap">
    <h2 class="title-1">overview</h2>
</div>
</div>
</div>
<div class="row m-t-25">
<div class="col-sm-4 col-lg-4">
<div class="overview-item overview-item--c1">
    <div class="overview__inner">
        <div class="overview-box clearfix">
            <div class="icon">
                <i class="fas fa-list-alt"></i>
            </div>
            <div class="text">
                <h2>{{ DB::table('categories')->select('id')->where('category_type','product')->where('category_status','Active')->count() }}</h2>
                <span>total products</span>
            </div>
        </div>

    </div>
</div>
</div>
<div class="col-sm-4 col-lg-4">
<div class="overview-item overview-item--c2">
    <div class="overview__inner">
        <div class="overview-box clearfix">
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
            </div>
            <div class="text">
            <h2>{{ DB::table('admins')->select('admin_name')->where('admin_status','Active')->count() }}</h2>
                <span>active users</span>
            </div>
        </div>

    </div>
</div>
</div>
<div class="col-sm-4 col-lg-4">
<div class="overview-item overview-item--c3">
    <div class="overview__inner">
        <div class="overview-box clearfix">
            <div class="icon">
                <i class="zmdi zmdi-email-open"></i>
            </div>
            <div class="text">
                <h2>{{ DB::table('enquiries')->select('id')->count() }}</h2>
                <span>enquiries receieved</span>
            </div>
        </div>

    </div>
</div>
</div>

</div>


@if(!empty($admin_data->admin_map))
<div class="row">
<div class="col-lg-12">
<div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
        <div class="bg-overlay bg-overlay--blue"></div>
        <h3><i class="zmdi zmdi-map"></i>Google Map Location</h3>
    </div>
    <div class="au-task js-list-load">
        <div class="iframe-rwd">
      {!! $admin_data->admin_map !!}
        </div>
    </div>
</div>
</div>
</div>
@endif
    </div>
</div>

@endsection
