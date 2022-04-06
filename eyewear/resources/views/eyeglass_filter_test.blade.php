@extends('layouts.app')

@php

 $meta_title = $meta_description = $meta_keywords = "";

 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Eyeglasses";

 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "EYEGLASSES Meta Description";

 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "EYEGLASSES Meta Keywords";

@endphp

 @section('title',$meta_title)

 @section('description',$meta_description)

 @section('keywords',$meta_keywords)


 <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/'.$admin_data->admin_favicon) }}">





<style>

    .form-select {

        line-height: 1.2 !important;

    }

</style>

@section('content')



    <section>

        <div class="brand_banner">

            <div class="container">

                <div class="brand_banner_content">

                    <div class="brand_banner_content_text text-center">

                        <h1 class="brand_bannner_head">Eyeglass</h1>

                        <nav aria-label="breadcrumb">

                            <ol class="breadcrumb breadcrumbStyle justify-content-center">

                                <li class="breadcrumb-item"><a href="{{route('eyeglasses.page')}}">Back</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Eyeglass</li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <section>

        <div class="product_detail section_space pb-0">

            <div class="container">

                <div class="product_deatail_list">

                    <div class="product_deatail_list_text">

                        <div class="lineTitleCol">

                            <h6 class="lineTitle">Explore Our Products</h6>



                        </div>

                        <h2 class="product_detail_head lgTitle darkColor">Most Loved Frames</h2>

                    </div>

                    <!--================== We found =============================-->

                    <p style="color:grey; text-align:center;">We found <span class="count">{{$products['total']}}</span>

                        products available for you</p>

                    <!--================== We found =============================-->

                    <div class="filterColMain pt-3">

                        <div class="filterCol">

                            <div class="row g-2 g-md-3">

                                <div class="col">

                                    <a class="btn btnDark w-100 filterBtn" data-bs-toggle="offcanvas" role="button"

                                       href="#filterCanvas" aria-controls="filterCanvas">

                                        <span class="filterIcon">

                                            <img src="{{asset('uploaded_files/assets/images/filter-icon.svg')}}"

                                                 alt="...">

                                        </span>

                                        <span>Filter</span>

                                    </a>

                                </div>

                                <div class="col">

                                    <!--====================== sorting =====================-->

                                    <form class="filter-form-product-for" method="get"

                                          action="{{url('/filter-product-for')}}">

                                    @csrf

                                    @method('GET')



                                    <!------------------------- hidden ------------------------>

                                        <input type="hidden" class="form-control" name="search_product"

                                               class="search_product"

                                               @isset($search_product) value="{{$search_product}}" @endisset>



                                        <input type="hidden" class="form-control" name="glass_type" class="glass_type"

                                               @isset($glass_type) value="{{$glass_type}}" @endisset>



                                        <input type="hidden" class="form-control" name="color_array" class="colors"

                                               @isset($color_array) value="{{$color_array}}" @endisset>



                                        <input type="hidden" class="form-control" name="brand_array" class="brands"

                                               @isset($brand_array) value="{{$brand_array}}" @endisset>



                                        <input type="hidden" class="form-control" name="gender_array" class="genders"

                                               @isset($gender_array) value="{{$gender_array}}" @endisset>



                                        <input type="hidden" class="form-control" name="shape_array" class="shapes"

                                               @isset($shape_array) value="{{$shape_array}}" @endisset>



                                        <input type="hidden" class="form-control" name="frame_array" class="frames"

                                               @isset($frame_array) value="{{$frame_array}}" @endisset>



                                        <input type="hidden" class="form-control" name="material_array"

                                               class="materials"

                                               @isset($material_array) value="{{$material_array}}" @endisset>



                                        <input type="hidden" name="min_price" class="min_price"

                                               @isset($min_price) value="{{$min_price}}" @endisset>

                                        <input type="hidden" name="max_price" class="max_price"

                                               @isset($max_price) value="{{$max_price}}" @endisset>

                                        <input type="hidden" name="product_for" id="product_for"

                                               value="{{$product_for}}">



                                        <!--------------------------- hidden --------------------------->

                                        <select name="order_filter" id="order_filter"

                                                onchange="filter_product_for('order_filter')"

                                                class="form-select selectStyle" aria-label="Default select example">

                                            <option value="Default">Sort by</option>

                                            <option value="Latest"

                                                    @isset($order_filter) @if($order_filter=="Latest") selected @endif @endisset>

                                                Latest

                                            </option>

                                            <option value="Low"

                                                    @isset($order_filter) @if($order_filter=="Low") selected @endif @endisset>

                                                Price: low to high

                                            </option>

                                            <option value="High"

                                                    @isset($order_filter) @if($order_filter=="High") selected @endif @endisset>

                                                Price: high to low

                                            </option>

                                            <option value="Sort_ASC"

                                                    @isset($order_filter) @if($order_filter=="Sort_ASC") selected @endif @endisset>

                                                A to Z

                                            </option>

                                            <option value="Sort_DESC"

                                                    @isset($order_filter) @if($order_filter=="Sort_DESC") selected @endif @endisset>

                                                Z to A

                                            </option>

                                        </select>

                                    </form>



                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="productColMain">

                        <div class="row g-4">

                        @foreach($products['data'] as $product)

                            @php

                                $brand = DB::table('categories')->select('category_name')->where('id',$product['category_parent_id'])->first();

                            @endphp

                            <!-- card start -->

                                <div class="col-md-6 col-xl-4">

                                    <div class="cardStyle1">



                                        @if($product['category_is_discount']=="Yes")

                                            <span class="discountCol"> {{$product['category_discount']}}% </span>

                                        @endif



                                        <div class="productImg">
 <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" target="_blank">
                                            <div class="imgCol">

                                                @if(!empty($product['category_image_name']))

                                                    <img src="{{asset('uploaded_files/product/'.$product['category_image_name'])}}"

                                                         alt="{{$product['category_name']}}"

                                                         title="{{$product['category_name']}}" class="img-fluid">



                                                @endif

                                            </div>
</a>
                                            @php

                                                $get_current_color = DB::table('product_colors')->where('id',$product['category_color'])->first();

                                            @endphp

                                            <div class="color_builts">

                                                <ul>

                                                    @php

                                                        $group_ids = explode(',',$product['category_group_ids']);

                                                        $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();

                                                        $i=1;

                                                    @endphp

                                                    @if(!empty($product['category_group_ids']))



                                                        @foreach($group_prd as $group)

                                                            @php

                                                                $color_data = DB::table('product_colors')->where('id',$group->category_color)->first();

                                                            @endphp

                                                            <li>

                                                                <a href="{{url('/frame/'.$group->category_slug_name.'.html')}}"

                                                                   class="colorCol actColor btn-tool @if($group->category_slug_name==$product['category_slug_name']) color-btn @endif ">

                                                                    <img src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}"

                                                                         alt="..."></a>

                                                            </li>

                                                            @php

                                                                $i++;

                                                            @endphp

                                                        @endforeach

                                                    @else

                                                        <li>

                                                            <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}"

                                                               class="colorCol"><img

                                                                        src="{{asset('uploaded_files/color_image/'.$get_current_color->color_image_name)}}"

                                                                        alt="..."></a>

                                                        </li>

                                                    @endif

                                                </ul>

                                            </div>

                                        </div>

                                        <div class="contentCol">

                                            <h4 class="brandCol">{{$brand->category_name}}</h4>
     <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" style="text-decoration:none; color:black;">
                                            <p>{{Str::limit($product['category_name'],30,$end='..')}}</p>
</a>
                                            <span class="priceCol">

                                                {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_discount_price'])}}



                                                @if($product['category_is_discount']=="Yes")

                                                    <strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_price'])}}</strike>

                                                @endif    

                                            </span>

                                            <div class="row gx-2">

                                                <div class="col-auto">

                                                    <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}"

                                                       class="btn btnDark w-100 addCartBtn">ADD TO CART</a>

                                                </div>

                                                <div class="col">

                                                    <a href="javascript:void(0)" class="btn btnDark_outline w-100 add_to_wishlist">

                                                        ADD TO WISHLIST</a>
                                                        

                                                </div>

                                            </div>

                                            <div class="row gx-2">

                                                <span class="wish_list_mssg"></span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                        @endforeach

                        <!-- card end -->

                            <!-- 2end number card start  -->



                            <!-- 8 number card end  -->

                        </div>

                        <!--=============================== pagination =======================-->

                        <div class="d-flex justify-content-between">

                            <div class="">



                                Showing {{$products['from']}} to {{$products['to']}} of {{$products['total']}}

                                ({{$products['last_page']}} Pages)

                            </div>

                            <div class="">   {{$data->appends($_GET)->links()}}        </div>

                        </div>

                        <!--========================= pagination ======================-->

                        <!------------------>

                        <div class="btnCol text-center">

                            <!--<a href="javascript:void(0)" class="btn btnPrimary minWdBtn btnNew">Load More</a>-->

                        </div>

                        <!---------->





                    </div>

                </div>

            </div>

        </div>



    </section>

    <!--========================================== section end =====================================-->

    <div class="offcanvas offcanvas-start offCanvasStyle" tabindex="-1" id="filterCanvas"

         aria-labelledby="filterCanvasLabel">

        <div class="offcanvas-header">

            <h5 class="offcanvas-title" id="filterCanvasLabel"></h5>

            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>

        </div>



        <div class="backDrop"></div>

        <div class="offcanvas-body">



            <!-- <h5 class="smTitle">Gender</h5> -->

            <div class="filterChekCol">

                <!-- <ul>

                    <li>

                        <span class="filterChek">

                            <input type="checkbox" class="btn-check" id="genderCheck_01" autocomplete="off">

                            <label class="btn btn-outline-secondary" for="genderCheck_01">Male</label>

                        </span>

                    </li>

                    <li>

                        <span class="filterChek">

                            <input type="checkbox" class="btn-check" id="genderCheck_02" autocomplete="off">

                            <label class="btn btn-outline-secondary" for="genderCheck_02">Female</label>

                        </span>

                    </li>

                    <li>

                        <span class="filterChek">

                            <input type="checkbox" class="btn-check" id="genderCheck_03" autocomplete="off">

                            <label class="btn btn-outline-secondary" for="genderCheck_03">Kid</label>

                        </span>

                    </li>

                </ul> -->

            </div>

            <div class="widget-wrap">

                <div class="widget-search">



                    <input type="text" placeholder="Search" class="form-control" name="search_product"

                           id="search_product" @isset($search_product) value="{{$search_product}}" @endisset>



                    <a onclick="filter_product_for('search_filter')" style="font-weight: 900 !important;position: relative !important;top: -1.6rem !important;left: 19.5rem !important; background-color: white important;"><i class="fa fa-search"></i></a>



                    @if(isset($search_product) && !empty($search_product))

                        @php

                            $search_product_key = 'search_product';

                            $url = Request::fullURL();

                           

                           // Remove specific parameter from query string

                           $filteredURL = preg_replace('~(\?|&)'.$search_product_key.'=[^&]*~', '$1', $url);



                        @endphp



                        <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter">

                                <i class="fa fa-times-circle"></i></a></span>

                    @endif

                </div>

            </div>



            <!--================================ our brands ============================-->

            <div class="left-cate" id="example2">

                <h5 class="smTitle">Our Brands</h5>

                @if(isset($brand_array) && !empty($brand_array))

                    @php

                        $brand_key = 'brand_array';

                        $url = Request::fullURL();

                       

                       // Remove specific parameter from query string

                       $filteredURL = preg_replace('~(\?|&)'.$brand_key.'=[^&]*~', '$1', $url);



                    @endphp

                    <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter">

                            <i class="fa fa-times-circle"></i></a></span>

                @endif

                <div class="filterChekCol">

                    <ul>

                    @php

                        if(isset($brand_array)){

                        $check_brand = explode(',',$brand_array);

                        }

                    @endphp

                    <!--added Brands button only -->

                       <!--  <li>

                            <span class="filterChek">

                                <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">

                                <label class="btn btn-outline-secondary" for="btncheck1">Carrera</label>

                            </span>

                        </li> -->

                        <!--added Brands button only -->

                        @foreach($all_brands as $key=>$brand)



                            <!-- <li> -->

                                



                                    <li>
                                    	<span class="filterChek">

                                        <input type="checkbox" class="btn-check" name="brands[]" id="brands_{{$key}}" value="{{$brand->id}}"

                                       onclick="filter_product_for('brand_filter')"

                                       @if(isset($brand_array)) @if(in_array($brand->id,$check_brand)) checked @endif @endisset>

                                        <label class="btn btn-outline-secondary" for="brands_{{$key}}">{{$brand->category_name}}</label>
                                        </span>
                                    </li>



                                

                            <!-- </li> -->

                        @endforeach

                    </ul>

                </div>

            </div>

            <!--================================ our Colors ============================-->

            <h5 class="smTitle">colors</h5>



            @if(isset($color_array) && !empty($color_array))

                @php

                    $color_key = 'color_array';

                    $url = Request::fullURL();

                   

                   // Remove specific parameter from query string

                   $filteredURL = preg_replace('~(\?|&)'.$color_key.'=[^&]*~', '$1', $url);



                @endphp

                <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i

                                class="fa fa-times-circle"></i></a></span>

            @endif

            <div class="filterChekCol">

                <ul>

                @php

                    if(isset($color_array)){

                    $check_color = explode(',',$color_array);

                    }

                @endphp

                <!--======= for color ===========-->
<!-- 
                    <li>

                        <span class="filterChek">

                            <input type="checkbox" class="btn-check" id="btncheck-01" autocomplete="off">

                            <label class="btn colorBtn" for="btncheck-01">

                                <img src="" alt="...">

                            </label>

                        </span>

                    </li> -->

                    <!--======== for color ==============-->

                    @foreach($frame_colors as $k=>$color)

                        <li>

                            <span class="filterChek">

                                
                                <input class="btn-check" type="checkbox" name="colors[]" id="colors_{{$k}}" value="{{$color->id}}"

                                       onclick="filter_product_for('color_filter')"

                                       @if(isset($color_array)) @if(in_array($color->id,$check_color)) checked @endif @endisset>

                                <label class="btn colorBtn" for="colors_{{$k}}">

                                    <img src="{{asset('uploaded_files/color_image/'.$color->color_image_name)}}" alt="...">

                                </label>

                            </span>

                        </li>

                    @endforeach

                </ul>

            </div>

            <!--================================ Shapes ============================-->

            <h5 class="smTitle">SHAPES</h5>

            @if(isset($shape_array) && !empty($shape_array))

                @php

                    $shape_key = 'shape_array';

                    $url = Request::fullURL();

                   

                   // Remove specific parameter from query string

                   $filteredURL = preg_replace('~(\?|&)'.$shape_key.'=[^&]*~', '$1', $url);



                @endphp

                <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i

                                class="fa fa-times-circle"></i></a></span>

            @endif

            <div class="filterChekCol">

                <ul>

                @php

                    if(isset($shape_array)){

                    $check_shape = explode(',',$shape_array);

                    }

                @endphp

                <!-- SHAPES-->

<!--         <li>

          <span class="filterChek">

            <input type="checkbox" class="btn-check" id="btncheck-001" autocomplete="off">

            <label class="btn btn-outline-secondary" for="btncheck-001">Rectangle</label>

          </span>

        </li>
 -->
                    <!--SHAPES-->

    @foreach($frame_shapes as $k=>$shape)

        <li>

        	<span class="filterChek">

	     		<input class="btn-check" type="checkbox" name="shapes[]" id="shapes_{{$k}}" value="{{$shape->shape}}"

	            onclick="filter_product_for('shape_filter')"

	            @if(isset($shape_array)) @if(in_array($shape->shape,$check_shape))

	            checked @endif @endisset> 
	            <label class="btn btn-outline-secondary" for="shapes_{{$k}}">{{$shape->shape}}</label>

			</span>

 		</li>

    @endforeach

   </ul>

            </div>

            <!--================================ Material ============================-->

            <h5 class="smTitle">material</h5>

            @if(isset($material_array) && !empty($material_array))

                @php

                    $material_key = 'material_array';

                    $url = Request::fullURL();

                   

                   // Remove specific parameter from query string

                   $filteredURL = preg_replace('~(\?|&)'.$material_key.'=[^&]*~', '$1', $url);



                @endphp

                <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i

                                class="fa fa-times-circle"></i></a></span>

            @endif

            <div class="filterChekCol">

                <ul>

                @php

                    if(isset($material_array)){

                    $check_material = explode(',',$material_array);

                    }

                @endphp

                <!--material-->

        <li>

          <span class="filterChek">

            <input type="checkbox" class="btn-check" id="btncheck_01" autocomplete="off">

            <label class="btn btn-outline-secondary" for="btncheck_01">Acetate</label>

          </span>

        </li>

                    <!--material-->

                    @foreach($frame_materials as $k=>$material)

        <li>

            <span class="filterChek">

	            <input class="btn-check" type="checkbox" name="materials[]" id="materials_{{$k}}" value="{{$material->material}}"

	                onclick="filter_product_for('material_filter')"

	                 @if(isset($material_array)) @if(in_array($material->material,$check_material)) checked @endif @endisset> 
	                 <label class="btn btn-outline-secondary" for="materials_{{$k}}">{{$material->material}}</label>

            </span>

        </li>

                    @endforeach

                </ul>

            </div>



            <!--================================ Frame type ============================-->

            <h5 class="smTitle">frame type</h5>

            @if(isset($frame_array) && !empty($frame_array))

                @php

                    $frame_key = 'frame_array';

                    $url = Request::fullURL();

                   

                   // Remove specific parameter from query string

                   $filteredURL = preg_replace('~(\?|&)'.$frame_key.'=[^&]*~', '$1', $url);



                @endphp



                <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i

                                class="fa fa-times-circle"></i></a></span>

            @endif



            <div class="filterChekCol">

                <ul>

                @php

                    if(isset($frame_array)){

                    $check_frame = explode(',',$frame_array);

                    }

                @endphp

                <!--frame-->

                   <!--  <li>

          <span class="filterChek">

            <input type="checkbox" class="btn-check" id="btncheck__01" autocomplete="off">

            <label class="btn btn-outline-secondary" for="btncheck__01">Full Frame</label>

          </span>

                    </li> -->

                    <!--frame-->

                    @foreach($frame_types as $k=>$type)

                        <li>

                            <span class="filterChek">
								<input class="btn-check" type="checkbox" name="frames[]" id="frames_{{$k}}" value="{{$type->type}}"

	                                   onclick="filter_product_for('frame_filter')"

	                                   @if(isset($frame_array)) @if(in_array($type->type,$check_frame)) checked @endif @endisset>

	                            <label class="btn btn-outline-secondary" for="frames_{{$k}}">{{$type->type}}</label>

                        	</span>

                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>



    <!--=================================== old ============================-->







@endsection



