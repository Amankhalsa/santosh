<?php $__env->startSection('title',"Meta for {$product_for}"); ?>

<?php $__env->startSection('description',"Meta for {$product_for}"); ?>

<?php $__env->startSection('keywords',"Meta for {$product_for}"); ?>







<style>

    .form-select {

        line-height: 1.2 !important;

    }

</style>

<?php $__env->startSection('content'); ?>



    <section>

        <div class="brand_banner">

            <div class="container">

                <div class="brand_banner_content">

                    <div class="brand_banner_content_text text-center">

                        <h1 class="brand_bannner_head"><?php echo e($glass_type); ?></h1>

                        <nav aria-label="breadcrumb">

                            <ol class="breadcrumb breadcrumbStyle justify-content-center">

                                <li class="breadcrumb-item"><a href="<?php echo e(route('home.page')); ?>">Home</a></li>

                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($product_for); ?></li>

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

                    <p style="color:grey; text-align:center;">We found <span class="count"><?php echo e($products['total']); ?></span>

                        products available for you</p>

                    <!--================== We found =============================-->

                    <div class="filterColMain pt-3">

                        <div class="filterCol">

                            <div class="row g-2 g-md-3">

                                <div class="col">

                                    <a class="btn btnDark w-100 filterBtn" data-bs-toggle="offcanvas" role="button"

                                       href="#filterCanvas" aria-controls="filterCanvas">

                                        <span class="filterIcon">

                                            <img src="<?php echo e(asset('uploaded_files/assets/images/filter-icon.svg')); ?>"

                                                 alt="...">

                                        </span>

                                        <span>Filter</span>

                                    </a>

                                </div>

                                <div class="col">

                                    <!--====================== sorting =====================-->

                                    <form class="filter-form-product-for" method="get"

                                          action="<?php echo e(url('/filter-product-for')); ?>">

                                    <?php echo csrf_field(); ?>

                                    <?php echo method_field('GET'); ?>



                                    <!------------------------- hidden ------------------------>

                                        <input type="hidden" class="form-control" name="search_product"

                                               class="search_product"

                                               <?php if(isset($search_product)): ?> value="<?php echo e($search_product); ?>" <?php endif; ?>>



                                        <input type="hidden" class="form-control" name="glass_type" class="glass_type"

                                               <?php if(isset($glass_type)): ?> value="<?php echo e($glass_type); ?>" <?php endif; ?>>



                                        <input type="hidden" class="form-control" name="color_array" class="colors"

                                               <?php if(isset($color_array)): ?> value="<?php echo e($color_array); ?>" <?php endif; ?>>



                                        <input type="hidden" class="form-control" name="brand_array" class="brands"

                                               <?php if(isset($brand_array)): ?> value="<?php echo e($brand_array); ?>" <?php endif; ?>>



                                        <input type="hidden" class="form-control" name="gender_array" class="genders"

                                               <?php if(isset($gender_array)): ?> value="<?php echo e($gender_array); ?>" <?php endif; ?>>



                                        <input type="hidden" class="form-control" name="shape_array" class="shapes"

                                               <?php if(isset($shape_array)): ?> value="<?php echo e($shape_array); ?>" <?php endif; ?>>



                                        <input type="hidden" class="form-control" name="frame_array" class="frames"

                                               <?php if(isset($frame_array)): ?> value="<?php echo e($frame_array); ?>" <?php endif; ?>>



                                        <input type="hidden" class="form-control" name="material_array"

                                               class="materials"

                                               <?php if(isset($material_array)): ?> value="<?php echo e($material_array); ?>" <?php endif; ?>>



                                        <input type="hidden" name="min_price" class="min_price"

                                               <?php if(isset($min_price)): ?> value="<?php echo e($min_price); ?>" <?php endif; ?>>

                                        <input type="hidden" name="max_price" class="max_price"

                                               <?php if(isset($max_price)): ?> value="<?php echo e($max_price); ?>" <?php endif; ?>>

                                        <input type="hidden" name="product_for" id="product_for"

                                               value="<?php echo e($product_for); ?>">



                                        <!--------------------------- hidden --------------------------->

                                        <select name="order_filter" id="order_filter"

                                                onchange="filter_product_for('order_filter')"

                                                class="form-select selectStyle" aria-label="Default select example">

                                            <option value="Default">Sort by</option>

                                            <option value="Latest"

                                                    <?php if(isset($order_filter)): ?> <?php if($order_filter=="Latest"): ?> selected <?php endif; ?> <?php endif; ?>>

                                                Latest

                                            </option>

                                            <option value="Low"

                                                    <?php if(isset($order_filter)): ?> <?php if($order_filter=="Low"): ?> selected <?php endif; ?> <?php endif; ?>>

                                                Price: low to high

                                            </option>

                                            <option value="High"

                                                    <?php if(isset($order_filter)): ?> <?php if($order_filter=="High"): ?> selected <?php endif; ?> <?php endif; ?>>

                                                Price: high to low

                                            </option>

                                            <option value="Sort_ASC"

                                                    <?php if(isset($order_filter)): ?> <?php if($order_filter=="Sort_ASC"): ?> selected <?php endif; ?> <?php endif; ?>>

                                                A to Z

                                            </option>

                                            <option value="Sort_DESC"

                                                    <?php if(isset($order_filter)): ?> <?php if($order_filter=="Sort_DESC"): ?> selected <?php endif; ?> <?php endif; ?>>

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

                        <?php $__currentLoopData = $products['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php

                                $brand = DB::table('categories')->select('category_name')->where('id',$product['category_parent_id'])->first();

                            ?>

                            <!-- card start -->

                                <div class="col-md-6 col-xl-4">

                                    <div class="cardStyle1">



                                        <?php if($product['category_is_discount']=="Yes"): ?>

                                            <span class="discountCol"> <?php echo e($product['category_discount']); ?>% </span>

                                        <?php endif; ?>



                                        <div class="productImg">
 <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" target="_blank">
                                            <div class="imgCol">

                                                <?php if(!empty($product['category_image_name'])): ?>

                                                    <img src="<?php echo e(asset('uploaded_files/product/'.$product['category_image_name'])); ?>"

                                                         alt="<?php echo e($product['category_name']); ?>"

                                                         title="<?php echo e($product['category_name']); ?>" class="img-fluid">



                                                <?php endif; ?>

                                            </div>
</a>
                                            <?php

                                                $get_current_color = DB::table('product_colors')->where('id',$product['category_color'])->first();

                                            ?>

                                            <div class="color_builts">

                                                <ul>

                                                    <?php

                                                        $group_ids = explode(',',$product['category_group_ids']);

                                                        $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();

                                                        $i=1;

                                                    ?>

                                                    <?php if(!empty($product['category_group_ids'])): ?>



                                                        <?php $__currentLoopData = $group_prd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <?php

                                                                $color_data = DB::table('product_colors')->where('id',$group->category_color)->first();

                                                            ?>

                                                            <li>

                                                                <a href="<?php echo e(url('/frame/'.$group->category_slug_name.'.html')); ?>"

                                                                   class="colorCol actColor btn-tool <?php if($group->category_slug_name==$product['category_slug_name']): ?> color-btn <?php endif; ?> ">

                                                                    <img src="<?php echo e(asset('uploaded_files/color_image/'.$color_data->color_image_name)); ?>"

                                                                         alt="..."></a>

                                                            </li>

                                                            <?php

                                                                $i++;

                                                            ?>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php else: ?>

                                                        <li>

                                                            <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>"

                                                               class="colorCol"><img

                                                                        src="<?php echo e(asset('uploaded_files/color_image/'.$get_current_color->color_image_name)); ?>"

                                                                        alt="..."></a>

                                                        </li>

                                                    <?php endif; ?>

                                                </ul>

                                            </div>

                                        </div>

                                        <div class="contentCol">

                                            <h4 class="brandCol"><?php echo e($brand->category_name); ?></h4>
     <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" style="text-decoration:none; color:black;">
                                            <p><?php echo e(Str::limit($product['category_name'],30,$end='..')); ?></p>
</a>
                                            <span class="priceCol">

                                                <?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_discount_price'])); ?>




                                                <?php if($product['category_is_discount']=="Yes"): ?>

                                                    <strike id="mrp"><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_price'])); ?></strike>

                                                <?php endif; ?>    

                                            </span>

                                            <div class="row gx-2">

                                                <div class="col-auto">

                                                    <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>"

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

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- card end -->

                            <!-- 2end number card start  -->



                            <!-- 8 number card end  -->

                        </div>

                        <!--=============================== pagination =======================-->

                        <div class="d-flex justify-content-between">

                            <div class="">



                                Showing <?php echo e($products['from']); ?> to <?php echo e($products['to']); ?> of <?php echo e($products['total']); ?>


                                (<?php echo e($products['last_page']); ?> Pages)

                            </div>

                            <div class="">   <?php echo e($data->appends($_GET)->links()); ?>        </div>

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

                           id="search_product" <?php if(isset($search_product)): ?> value="<?php echo e($search_product); ?>" <?php endif; ?>>



                    <a onclick="filter_product_for('search_filter')" style="font-weight: 900 !important;position: relative !important;top: -1.6rem !important;left: 19.5rem !important; background-color: white important;"><i class="fa fa-search"></i></a>



                    <?php if(isset($search_product) && !empty($search_product)): ?>

                        <?php

                            $search_product_key = 'search_product';

                            $url = Request::fullURL();

                           

                           // Remove specific parameter from query string

                           $filteredURL = preg_replace('~(\?|&)'.$search_product_key.'=[^&]*~', '$1', $url);



                        ?>



                        <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter">

                                <i class="fa fa-times-circle"></i></a></span>

                    <?php endif; ?>

                </div>

            </div>



            <!--================================ our brands ============================-->

            <div class="left-cate" id="example2">

                <h5 class="smTitle">Our Brands</h5>

                <?php if(isset($brand_array) && !empty($brand_array)): ?>

                    <?php

                        $brand_key = 'brand_array';

                        $url = Request::fullURL();

                       

                       // Remove specific parameter from query string

                       $filteredURL = preg_replace('~(\?|&)'.$brand_key.'=[^&]*~', '$1', $url);



                    ?>

                    <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter">

                            <i class="fa fa-times-circle"></i></a></span>

                <?php endif; ?>

                <div class="filterChekCol">

                    <ul>

                    <?php

                        if(isset($brand_array)){

                        $check_brand = explode(',',$brand_array);

                        }

                    ?>

                    <!--added Brands button only -->

                       <!--  <li>

                            <span class="filterChek">

                                <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">

                                <label class="btn btn-outline-secondary" for="btncheck1">Carrera</label>

                            </span>

                        </li> -->

                        <!--added Brands button only -->

                        <?php $__currentLoopData = $all_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                            <!-- <li> -->

                                



                                    <li>
                                    	<span class="filterChek">

                                        <input type="checkbox" class="btn-check" name="brands[]" id="brands_<?php echo e($key); ?>" value="<?php echo e($brand->id); ?>"

                                       onclick="filter_product_for('brand_filter')"

                                       <?php if(isset($brand_array)): ?> <?php if(in_array($brand->id,$check_brand)): ?> checked <?php endif; ?> <?php endif; ?>>

                                        <label class="btn btn-outline-secondary" for="brands_<?php echo e($key); ?>"><?php echo e($brand->category_name); ?></label>
                                        </span>
                                    </li>



                                

                            <!-- </li> -->

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </div>

            </div>

            <!--================================ our Colors ============================-->

            <h5 class="smTitle">colors</h5>



            <?php if(isset($color_array) && !empty($color_array)): ?>

                <?php

                    $color_key = 'color_array';

                    $url = Request::fullURL();

                   

                   // Remove specific parameter from query string

                   $filteredURL = preg_replace('~(\?|&)'.$color_key.'=[^&]*~', '$1', $url);



                ?>

                <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i

                                class="fa fa-times-circle"></i></a></span>

            <?php endif; ?>

            <div class="filterChekCol">

                <ul>

                <?php

                    if(isset($color_array)){

                    $check_color = explode(',',$color_array);

                    }

                ?>

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

                    <?php $__currentLoopData = $frame_colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li>

                            <span class="filterChek">

                                
                                <input class="btn-check" type="checkbox" name="colors[]" id="colors_<?php echo e($k); ?>" value="<?php echo e($color->id); ?>"

                                       onclick="filter_product_for('color_filter')"

                                       <?php if(isset($color_array)): ?> <?php if(in_array($color->id,$check_color)): ?> checked <?php endif; ?> <?php endif; ?>>

                                <label class="btn colorBtn" for="colors_<?php echo e($k); ?>">

                                    <img src="<?php echo e(asset('uploaded_files/color_image/'.$color->color_image_name)); ?>" alt="...">

                                </label>

                            </span>

                        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>

            </div>

            <!--================================ Shapes ============================-->

            <h5 class="smTitle">SHAPES</h5>

            <?php if(isset($shape_array) && !empty($shape_array)): ?>

                <?php

                    $shape_key = 'shape_array';

                    $url = Request::fullURL();

                   

                   // Remove specific parameter from query string

                   $filteredURL = preg_replace('~(\?|&)'.$shape_key.'=[^&]*~', '$1', $url);



                ?>

                <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i

                                class="fa fa-times-circle"></i></a></span>

            <?php endif; ?>

            <div class="filterChekCol">

                <ul>

                <?php

                    if(isset($shape_array)){

                    $check_shape = explode(',',$shape_array);

                    }

                ?>

                <!-- SHAPES-->

<!--         <li>

          <span class="filterChek">

            <input type="checkbox" class="btn-check" id="btncheck-001" autocomplete="off">

            <label class="btn btn-outline-secondary" for="btncheck-001">Rectangle</label>

          </span>

        </li>
 -->
                    <!--SHAPES-->

    <?php $__currentLoopData = $frame_shapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$shape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <li>

        	<span class="filterChek">

	     		<input class="btn-check" type="checkbox" name="shapes[]" id="shapes_<?php echo e($k); ?>" value="<?php echo e($shape->shape); ?>"

	            onclick="filter_product_for('shape_filter')"

	            <?php if(isset($shape_array)): ?> <?php if(in_array($shape->shape,$check_shape)): ?>

	            checked <?php endif; ?> <?php endif; ?>> 
	            <label class="btn btn-outline-secondary" for="shapes_<?php echo e($k); ?>"><?php echo e($shape->shape); ?></label>

			</span>

 		</li>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

   </ul>

            </div>

            <!--================================ Material ============================-->

            <h5 class="smTitle">material</h5>

            <?php if(isset($material_array) && !empty($material_array)): ?>

                <?php

                    $material_key = 'material_array';

                    $url = Request::fullURL();

                   

                   // Remove specific parameter from query string

                   $filteredURL = preg_replace('~(\?|&)'.$material_key.'=[^&]*~', '$1', $url);



                ?>

                <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i

                                class="fa fa-times-circle"></i></a></span>

            <?php endif; ?>

            <div class="filterChekCol">

                <ul>

                <?php

                    if(isset($material_array)){

                    $check_material = explode(',',$material_array);

                    }

                ?>

                <!--material-->

        <li>

          <span class="filterChek">

            <input type="checkbox" class="btn-check" id="btncheck_01" autocomplete="off">

            <label class="btn btn-outline-secondary" for="btncheck_01">Acetate</label>

          </span>

        </li>

                    <!--material-->

                    <?php $__currentLoopData = $frame_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <li>

            <span class="filterChek">

	            <input class="btn-check" type="checkbox" name="materials[]" id="materials_<?php echo e($k); ?>" value="<?php echo e($material->material); ?>"

	                onclick="filter_product_for('material_filter')"

	                 <?php if(isset($material_array)): ?> <?php if(in_array($material->material,$check_material)): ?> checked <?php endif; ?> <?php endif; ?>> 
	                 <label class="btn btn-outline-secondary" for="materials_<?php echo e($k); ?>"><?php echo e($material->material); ?></label>

            </span>

        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>

            </div>



            <!--================================ Frame type ============================-->

            <h5 class="smTitle">frame type</h5>

            <?php if(isset($frame_array) && !empty($frame_array)): ?>

                <?php

                    $frame_key = 'frame_array';

                    $url = Request::fullURL();

                   

                   // Remove specific parameter from query string

                   $filteredURL = preg_replace('~(\?|&)'.$frame_key.'=[^&]*~', '$1', $url);



                ?>



                <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i

                                class="fa fa-times-circle"></i></a></span>

            <?php endif; ?>



            <div class="filterChekCol">

                <ul>

                <?php

                    if(isset($frame_array)){

                    $check_frame = explode(',',$frame_array);

                    }

                ?>

                <!--frame-->

                   <!--  <li>

          <span class="filterChek">

            <input type="checkbox" class="btn-check" id="btncheck__01" autocomplete="off">

            <label class="btn btn-outline-secondary" for="btncheck__01">Full Frame</label>

          </span>

                    </li> -->

                    <!--frame-->

                    <?php $__currentLoopData = $frame_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li>

                            <span class="filterChek">
								<input class="btn-check" type="checkbox" name="frames[]" id="frames_<?php echo e($k); ?>" value="<?php echo e($type->type); ?>"

	                                   onclick="filter_product_for('frame_filter')"

	                                   <?php if(isset($frame_array)): ?> <?php if(in_array($type->type,$check_frame)): ?> checked <?php endif; ?> <?php endif; ?>>

	                            <label class="btn btn-outline-secondary" for="frames_<?php echo e($k); ?>"><?php echo e($type->type); ?></label>

                        	</span>

                        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>

            </div>

        </div>

    </div>



    <!--=================================== old ============================-->







<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/product-for.blade.php ENDPATH**/ ?>