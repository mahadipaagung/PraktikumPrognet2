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
        <h3 class="panel-tittle">Edit Courier</h3>
    </div>
 <div class="panel-body">
<form action="/courier/{{$courier->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{method_field('PUT')}}
    <div class="form-group row">
        <label class="col-sm-1 col-form-label">Courier</label>
        <div class="col-sm-10">
            <input name="courier" type="text" class="form-control" value="{{$courier->courier}}">
        </div>
    </div>

    <br>

    <div class="panel-body">
        <a href="/courier" class="btn btn-danger">Kembali</a>
        <button value="submit" type="submit" class="btn btn-info">Ubah</button>
    </div>
</form>
@endsection