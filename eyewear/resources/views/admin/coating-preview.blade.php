@if($coatings->isNotEmpty())
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<nav>
<ol class="breadcrumb" id="breadcrumb_cat">
 
  <strong>Coatings & Price</strong> &nbsp; Details

</ol>
</nav>
</div>
<div class="card-body card-block">

@foreach($coatings as $coating)


<div class="row form-group">
<div class="col-12">
<input type="hidden" name="coating_status[]" value="add" />
<input type="hidden" name="coating_id[]" id="coating_id[]" value="{{ $coating->id }}" >

<label for="text-input" class=" form-control-label" style="font-weight:520">{{$coating->category_name}}</label>
</div>
</div>

<div class="row form-group">
<div class="col-6">
<label for="text-input" class="form-control-label" style="font-weight:520">Cost</label>     
<input type="number" name="coating_cost[]" id="coating_cost[]" placeholder="Cost" class="form-control" />
</div>
<div class="col-6">
<label for="text-input" class="form-control-label" style="font-weight:520">Price</label>     
<input type="number" name="coating_price[]" id="coating_price[]" placeholder="Price" class="form-control" />
</div>

</div>

@endforeach


</div>

</div>

</div>
@endif