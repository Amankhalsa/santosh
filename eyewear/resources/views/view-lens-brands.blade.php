@if($lens_brands->isNotEmpty())
<div class="row mt-5 mb-5">
 <div class="col-md-12 text-center">
     <h4 class="divyanshu">Lens Brand</h4>
 </div>
 </div>
 
 @foreach($lens_brands as $brand)
<div class="row desc-card" onclick="getLenses('{{$brand->id}}','{{$lens_color_id}}','{{$is_tint}}'),tokkenset('fourth-card')">
<div class="col-10 flxc">
<img src="{{asset('uploaded_files/lens/'.$brand->category_image_name)}}" class="flxc-img" alt="{{$brand->category_name}}" title="{{$brand->category_name}}" width="50px" height="50px" />
<h4 class="flxc-h4"><strong>{{$brand->category_name}}</strong></h4>
</div>
@if(!empty($brand->category_tag_line))
<div class="col-2">
<div class="popup">
    <i class="fa fa-info"></i>
    <span class="popuptext" id="myPopup">{!!$brand->category_tag_line!!}</span>
</div>
</div>
@endif
</div>
 @endforeach

@else

<div class="row">
<div class="col-md-12 text-center">
 <h4>No Lens Available for given prescription, Please upload your prescription</h4>
</div>
</div>

<div class="row">
<div class="col-md-12 text-center">
    <div class="subcribe-form fl-wrap">
       
 <form method="post" action="{{url('/upload-prescription')}}" id="subscribe" enctype="multipart/form-data">
     <div class="row">
         <div class="col-lg-6">
  @csrf
  <input type="file" class="pt-2" name="prescription" required/>
  </div>
  <div class="col-lg-6">
  <input type="email" name="email" class="enteremail" placeholder="Enter your email" required/>
  <button type="submit" id="subscribe-button" class="subscribe-button color-bg">Submit</button>
  </div>
  </div>
 </form>    
    </div>

</div>
</div>

@endif