
<!--======================-->
<div class="offcanvas offcanvas-start offCanvasStyle" tabindex="-1" id="filterCanvas" aria-labelledby="filterCanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="filterCanvasLabel"></h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
<!--sunglass-->
 
<!-- slider   -->
 <div class="backDrop"></div>
  <div class="offcanvas-body">

    <h5 class="smTitle">Gender</h5>
    <div class="filterChekCol">
      <ul>
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
      </ul>
    </div>

    <h5 class="smTitle">Our Brands</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck1">Carrera</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck2">MARC JACOBS</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck3">Fendi</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck4">JIMMY CHOO</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck5">Hugo</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck6">GIVENCHY</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck7" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck7">Tommy Hilfiger</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck8" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck8">Elie Saab</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck9" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck9">Polaroid</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck10" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck10">Kate Spade</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck11" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck11">Burberry</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck12" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck12">Gucci</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck13" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck13">Bvlgari</label>
          </span>
        </li>
      </ul>
    </div>

    <h5 class="smTitle">colors</h5>
    <div class="filterChekCol">
@php
$get_color_data = DB::table('product_colors')->get(); 
@endphp 

      <ul>
          <!---------------->
@foreach($get_color_data as $key => $color_data )
          <!------------------->
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-01" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-01">
                <img src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}" alt="...">
                </label>
          </span>
        </li>
    @endforeach

    
      </ul>
    </div>

    <h5 class="smTitle">SHAPES</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-001" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-001">Rectangle</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-002" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-002">Square</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-003" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-003">Round</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-004" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-004">Aviator</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-005" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-005">Cat-eye</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-006" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-006">Navigator</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-007" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-007">Hexagon</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-008" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-008">Round - Oval</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-009" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-009">Butterfly</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-0010" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-0010">Pilot</label>
          </span>
        </li>
      </ul>
    </div>

    <h5 class="smTitle">material</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_01" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_01">Acetate</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_02" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_02">Metal</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_03" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_03">Mixed</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_04" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_04">Acetate And Metal</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_05" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_05">Titanium</label>
          </span>
        </li>
      </ul>
    </div>


    <h5 class="smTitle">frame type</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck__01" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck__01">Full Frame</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck__02" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck__02">Semi Rim</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck__03" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck__03">Rimless</label>
          </span>
        </li>
      </ul>
    </div>
  </div>
</div>
 <!--sidebar end -->