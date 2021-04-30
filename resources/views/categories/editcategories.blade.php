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
        <h3 class="panel-tittle">Edit Product Categories</h3>
    </div>
 <div class="panel-body">
<form action="/categories/{{$dataCategory->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{method_field('PUT')}}
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Category Name</label>
        <div class="col-sm-10">
            <input name="category_name" type="text" class="form-control" value="{{$dataCategory->category_name}}">
        </div>
    </div>

    <br>

    <div class="panel-body">
        <a href="/categories" class="btn btn-danger">Kembali
        </a>
        <button value="submit" type="submit" class="btn btn-info">Ubah</button>
    </div>
</form>
@endsection