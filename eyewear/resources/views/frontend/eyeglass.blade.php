@if($eyeglasses->isNotEmpty())

<div class="productColMain">
                 <!--Eyeglasses header   -->

   <!--Eyeglasses header   -->
            <div class="row g-4">
@foreach($eyeglasses as $product)
@php
$brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
@endphp
<!--card start -->
<div class="col-md-6 col-xl-4">
<div class="cardStyle1">
<!--discount part-->
@if($product['category_is_discount']=="Yes")    
<span class="discountCol"> {{$product['category_discount']}}%</span>
@endif
<!--discount part-->
<div class="productImg">
        <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" target="_blank">
<div class="imgCol">
@if(!empty($product->category_image_name)) 
<img src="{{asset('uploaded_files/product/'.$product->category_image_name)}}" alt="image of {{$brand->category_name}}"  title="{{$brand->category_for}}">
@else
<img  src="{{ asset('admin_assets/images/no_image.jpg') }}" alt="image of {{$brand->category_name}}" title="{{$brand->category_for }}">
@endif
</div>
</a>
@php
$get_current_color = DB::table('product_colors')->where('id',$product->category_color)->first(); 
@endphp
<div class="color_builts">
  <ul>
@php
$group_ids = explode(',',$product->category_group_ids);
$group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();
$i=1;
@endphp

@if(!empty($product->category_group_ids))  
@foreach($group_prd as $group)
@php
$color_data = DB::table('product_colors')->where('id',$group->category_color)->first(); 
@endphp        
<li>
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}" target="_blank"  class="colorCol actColor btn-tool @if($group->category_slug_name==$product->category_slug_name) color-btn @endif" target="_blank">
<img src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}" alt="..."></a>
</li>
@php
$i++;
@endphp   
@endforeach
@else
<li>
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"  class="colorCol"  >
<img src="{{asset('uploaded_files/color_image/'.$get_current_color->color_image_name)}}" alt="...."></a>
</li>
@endif
                      </ul>
                    </div>
                  </div>
                  <div class="contentCol">
                    <!--brand name-->
                    <h4 class="brandCol">{{$brand->category_name}}</h4>
                       <!--brand name-->
            <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" style="text-decoration:none; color:black;">
                    <p> {{strtoupper(Str::limit($product->category_name,30,$end='...'))}}</p>
                        </a>
                    <!--price-->
                    <span class="priceCol">
                        {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)}} 
                         </span>
                         <span>
             @if($product->category_is_discount=="Yes")
<strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)}}</strike>
@endif
                             </span>
                         <!--price-->
                    <div class="row gx-2">
                      <div class="col-auto">

       <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                      </div>
                      <div class="col">

            <form action="{{url('/add-wishlist')}}" method="post">
 @csrf
 @method('POST')
<input type="hidden" name="product_id" class="product_id" value="{{$product->id}}"/>
<input type="hidden" value="1" name="qty" />
<button type="submit" value="Add To WISHLIST"  class="btn btnDark_outline w-100" >
  ADD TO WISHLIST</button>
</form>   
    
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            
            <div class="btnCol text-center">
              <a href="{{url('/eyeglasses/women')}}" target="_blank" class="btn btnPrimary minWdBtn btnNew">Shop Now</a>
            </div>
          </div>
          @endif