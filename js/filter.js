 function filter(filter_type){
  	var min_price = $('#min_price').val();
 	var max_price = $('#max_price').val();
 	var search_product = $('#search_product').val();
 	$('.min_price').val(min_price);
 	$('.max_price').val(max_price);
    $('.search_product').val(search_product);
    
  var gender = document.getElementsByName('genders[]');
	var gender_array = "";
	 for (var i=0, n=gender.length;i<n;i++) 
	 { if (gender[i].checked){
	   gender_array += ","+gender[i].value;}}
	if (gender_array) gender_array = gender_array.substring(1);
    $('.genders').val(gender_array);
    
    var shape = document.getElementsByName('shapes[]');
	var shape_array = "";
	 for (var i=0, n=shape.length;i<n;i++) 
	 { if (shape[i].checked){
	   shape_array += ","+shape[i].value;}}
	if (shape_array) shape_array = shape_array.substring(1);
    $('.shapes').val(shape_array);
    
    var frame = document.getElementsByName('frames[]');
	var frame_array = "";
	 for (var i=0, n=frame.length;i<n;i++) 
	 { if (frame[i].checked){
	   frame_array += ","+frame[i].value;}}
	if (frame_array) frame_array = frame_array.substring(1);
    $('.frames').val(frame_array);
    
    var material = document.getElementsByName('materials[]');
	var material_array = "";
	 for (var i=0, n=material.length;i<n;i++) 
	 { if (material[i].checked){
	   material_array += ","+material[i].value;}}
	if (material_array) material_array = material_array.substring(1);
    $('.materials').val(material_array);
    
    var color = document.getElementsByName('colors[]');
	var color_array = "";
	 for (var i=0, n=color.length;i<n;i++) 
	 { if (color[i].checked){
	   color_array += ","+color[i].value;}}
	if (color_array) color_array = color_array.substring(1);
    $('.colors').val(color_array);
    
 $('.filter-form').submit();
 
 }
 
 
 /* Function for Product For(Man,Woman,Junior) */
 
  function filter_product_for(filter_type){
  	var min_price = $('#min_price').val();
 	var max_price = $('#max_price').val();
 	var search_product = $('#search_product').val();
 	$('.min_price').val(min_price);
 	$('.max_price').val(max_price);
    $('.search_product').val(search_product);
    
    var brand = document.getElementsByName('brands[]');
	var brand_array = "";
	 for (var i=0, n=brand.length;i<n;i++) 
	 { if (brand[i].checked){
	   brand_array += ","+brand[i].value;}}
	if (brand_array) brand_array = brand_array.substring(1);
    $('.brands').val(brand_array);
    
    var gender = document.getElementsByName('genders[]');
	var gender_array = "";
	 for (var i=0, n=gender.length;i<n;i++) 
	 { if (gender[i].checked){
	   gender_array += ","+gender[i].value;}}
	if (gender_array) gender_array = gender_array.substring(1);
    $('.genders').val(gender_array);
    
    var shape = document.getElementsByName('shapes[]');
	var shape_array = "";
	 for (var i=0, n=shape.length;i<n;i++) 
	 { if (shape[i].checked){
	   shape_array += ","+shape[i].value;}}
	if (shape_array) shape_array = shape_array.substring(1);
    $('.shapes').val(shape_array);
    
    var frame = document.getElementsByName('frames[]');
	var frame_array = "";
	 for (var i=0, n=frame.length;i<n;i++) 
	 { if (frame[i].checked){
	   frame_array += ","+frame[i].value;}}
	if (frame_array) frame_array = frame_array.substring(1);
    $('.frames').val(frame_array);
    
    var material = document.getElementsByName('materials[]');
	var material_array = "";
	 for (var i=0, n=material.length;i<n;i++) 
	 { if (material[i].checked){
	   material_array += ","+material[i].value;}}
	if (material_array) material_array = material_array.substring(1);
    $('.materials').val(material_array);
    
    var color = document.getElementsByName('colors[]');
	var color_array = "";
	 for (var i=0, n=color.length;i<n;i++) 
	 { if (color[i].checked){
	   color_array += ","+color[i].value;}}
	if (color_array) color_array = color_array.substring(1);
    $('.colors').val(color_array);
    
 $('.filter-form-product-for').submit();
 
 }