<div class="row prescr">
<div class="col-12 col-lg-12 col-md-12 col-sm-62" style="margin-bottom: 10px">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Prescription</th>
      <th scope="col">SPH</th>
      <th scope="col">CYL</th>
      <th scope="col">AXIS</th>
      <th scope="col">ADD</th>
      <th scope="col">PD</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Right</th>
      <td>{{$prescription->sph_right}}</td>
      <td>{{$prescription->cyl_right}}</td>
       <td>{{$prescription->axis_right}}</td>
        <td>{{$prescription->add_right}}</td>
       @if($prescription->is_pd2=="Yes")
         <td>{{$prescription->pupillary_distance_right}}</td>
       @else
         <td>{{$prescription->pupillary_distance}}</td>
       @endif     
    </tr>
    <tr>
      <th scope="row">Left</th>
      <td>{{$prescription->sph_left}}</td>
      <td>{{$prescription->cyl_left}}</td>
      <td>{{$prescription->axis_left}}</td>
        <td>{{$prescription->add_left}}</td>
         <td>{{$prescription->pupillary_distance_left}}</td>

    </tr>
  </tbody>
    <tfoot>
    <tr>
      <td>Description</td>
      <td>{{$prescription->prescription_comment}}</td>
       
    </tr>
  </tfoot>
</table>

@if($prescription->is_prism=="Yes")
<table class="table">
  <thead class="thead-light">
    <tr>
      <th class="min" scope="col">Prism</th>
      <th class="min" scope="col">VERTICAL (Δ)</th>
      <th class="min" scope="col">BASE DIRECTION</th>
      <th class="min" scope="col">HORIZONTAL (Δ)</th>
      <th class="min" scope="col">BASE DIRECTION</th>
    </tr>
  </thead>
   <tbody>
    <tr>
      <th scope="row">Right</th>
      <td>{{$prescription->prism_right_vertical}}</td>
      <td>{{$prescription->prism_right_vertical_direction}}</td>
       <td>{{$prescription->prism_right_horizontal}}</td>
        <td>{{$prescription->prism_right_horizontal_direction}}</td>
    </tr>
    <tr>
      <th scope="row">Left</th>
      <td>{{$prescription->prism_left_vertical}}</td>
      <td>{{$prescription->prism_left_vertical_direction}}</td>
      <td>{{$prescription->prism_left_horizontal}}</td>
       <td>{{$prescription->prism_left_horizontal_direction}}</td>
    </tr>
  </tbody>
    
</table>
@endif
</div>
</div>