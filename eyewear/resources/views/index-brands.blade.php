
<div class="">
    <div class="container">
        <div class="row padd-nee-001">
            @foreach($brands as $brand)
            <div class="col-lg-4 col-12" style="padding-left:5px; padding-right:5px; padding-bottom:10px;">
                <div class="img-effect">
                    <a href="{{url('/brand/'.$brand->category_slug_name.'.html')}}">
                        <img src="{{asset('uploaded_files/finalcat/'.$brand->category_image_name)}}" width="100%">
                    </a>
                </div>
                
            </div>
            
           @endforeach
        </div>
    </div>
</div>



