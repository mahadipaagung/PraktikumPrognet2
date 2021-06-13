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
        <form action="/admin/courier/edit/edit/" method="POST">
            @csrf
            <div class="form-group row">
                <label class="col-sm-1 col-form-label">Courier Name</label>
                <div class="col-sm-10">
                    <input name="courier_id" type="hidden" class="form-control" value="{{$courier->id}}">
                    <input name="courier" type="text" class="form-control" value="{{$courier->courier}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-1 col-form-label">Courier Code</label>
                <div class="col-sm-10">
                    <input name="code" type="text" class="form-control" value="{{$courier->code}}">
                </div>
            </div>
            <br>
            <div class="panel-body">
                <a href="/admin/courier" class="btn btn-danger">Cancel</a>
                <button value="submit" type="submit" class="btn btn-info">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection