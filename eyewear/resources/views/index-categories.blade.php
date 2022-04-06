@if($categories->isNotEmpty())
<div class=" padd-40">
<div class="container-fluid ">
<div class="row ">
<div class="col-lg-3 col-12 ">
<div class="rudra-heading">
<h2>Our Category</h2>
</div>
</div>
</div>

<div class="row padd-20">

@foreach($categories as $category)
    <div class="col-lg-2 col-12 pro">
    <a href="{{url('/'.$category->category_slug_name.'.html')}}">
    <div class="vastu-product">
      @if(!empty($category->category_image_name))  
        <img src="{{asset('uploaded_files/cat/'.$category->category_image_name)}}" style="width: 100%;height: 223px;">
      @else
      <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:233px;" alt="category" title="category" class="rounded"/>
      @endif  
        <h4>{{Str::limit($category->category_name,20,$end='...')}}</h4>
    </div>
    </a>
    </div>
@endforeach 
 
</div>
</div>

</div>
@endif