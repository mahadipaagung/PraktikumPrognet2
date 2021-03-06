@extends('admin')
@section('css')
<style>
  .dataTables_filter {
    float: right !important;
  }
</style>
@endsection
@section('page-contents')
<div class="panel">
  <div class="panel-heading">
      <h3 class="panel-tittle">Edit Discount</h3>
  </div>
 <div class="panel-body">
    <form action="/admin/discount/edit/edit/" method="POST">
      @csrf
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Percentage</label>
          <input type="number" name="percentage"  step="0.01" min="0" max="99" value="{{$discount->percentage}}"  class="form-control" >
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Start</label>
          <input type="date" name="start" value="{{ $discount->start }}"  class="form-control" >
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">End</label>
          <input type="hidden" name="id" value="{{ $discount->id  }}"  class="form-control" >
          <input type="date" name="end" value="{{ $discount->end  }}"  class="form-control" >
        </div>
        <div class="panel-body">
          <a href="/admin/products/edit/{{$discount->id_product}}" class="btn btn-danger">Cancel</a>
          <button value="submit" type="submit" class="btn btn-info">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  var today = new Date().toISOString().split('T')[0];
  document.getElementsByName("start")[0].setAttribute('min', today);
  document.getElementsByName("end")[0].setAttribute('min', today);
</script>
@endsection