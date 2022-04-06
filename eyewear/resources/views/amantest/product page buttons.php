    <div class="col-lg-6">
<button type="submit" class="btn btnDark w-100 addCartBtn">Add to cart</button>
 &nbsp;
@if($product_data->available_with_lens=="Yes")        
 @if($product_data->category_qty>0)
<button type="button" class="btn btnDark w-100 addCartBtn" onclick="addLensCart('{{$product_data->id}}')">
Buy with Lens</button>

@else
<button type="button" class="btn btnDark w-50 addCartBtn" disabled style="cursor:no-drop;background-color:#bdbdbd">
Buy with Lens</button>
@endif

@else

<button type="button" class="btn btnDark w-50 addCartBtn" disabled style="cursor:no-drop;background-color:#bdbdbd">
Buy with Lens</button>

<div class="popover__wrapper">
  <a href="#">
    <h5 class="popover__title"><i class="fa fa-question-circle"></i></h5>
  </a>
  <div class="popover__content">
   <p>{{$admin_data->available_with_lens_desc}}</p>
  </div>
</div>

@endif
    </div>



        <div class="col-lg-6">
<button type="submit" class="btn btnDark_outline w-100">ADD TO CART WITH PRESCRIPTION</button>
 &nbsp;

<button type="button" class="btn btnDark_outline w-100" onclick="addLensCart('{{$product_data->id}}')">
ADD TO WISHLIST</button>

    </div>