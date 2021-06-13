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
            <form action="/admin/categories/edit/edit/{{$pcat->id}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                        <input name="category_name" type="text" class="form-control" value="{{$pcat->category_name}}">
                    </div>
                </div>
                <br>

                <div class="panel-body">
                    <a href="/admin/categories" class="btn btn-danger">Cancel</a>
                    <button value="submit" type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection