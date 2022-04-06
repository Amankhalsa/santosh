

@if($sliders->isNotEmpty())    
<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel">
  <!--Indicators-->
 <ol class="carousel-indicators">
@php
$i=0;
@endphp
@foreach($sliders as $slider)
  <li data-target="#carousel-example-1z" data-slide-to="{{$i++}}" @if($i==0) class="active" @endif></li>
@endforeach    
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    <!--First slide-->
@php
$i=0;
@endphp
@foreach($sliders as $slider)    
<div class="carousel-item @if($i==0) active @endif">
    <a href="{{$slider->slider_button_link}}">
  <img class="d-block w-100" style="min-height:300px" src="{{asset('slider/'.$slider->slider_image_name)}}" alt="{{$slider->slider_title1}}" title="{{$slider->slider_title1}}"></a>
</div>
@php
 $i++;
@endphp
@endforeach       
       
      </div>
      <!--/.Slides-->
      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!--/.Controls-->
    </div>

@endif    