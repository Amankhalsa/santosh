@if($color_details->isNotEmpty())
<div class="card">
<div class="card-header">
<nav>
<ol class="breadcrumb" id="breadcrumb_cat">
 
  <strong>Tints</strong> &nbsp; Details

</ol>
  </nav>
</div>
<div class="card-body card-block">

@foreach($color_details as $detail)
<div class="row form-group">
<div class="col-12 col-md-9">
<input type="hidden" name="tint_status[]" value="add" />
<label for="text-input" class=" form-control-label" style="font-weight:520">{{$detail->category_name}}</label>
<input type="number" id="tint_price" name="tint_price[]" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->tint_price }}" @else value="{{ old('tint_price') }}" @endif >
</div>
<div class="col-12 col-md-3">
<input type="hidden" name="tint_id[]" id="tint_id" value="{{$detail->id}}">

</div>
</div>
@endforeach


</div>
</div>
@endif