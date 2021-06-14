@extends('admin')
@section('css')
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    </svg>
    <style>
        .dataTables_filter {
            float: right !important;
        }
    </style>
@endsection

@section('page-contents')
    @if(Session::has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Berhasil Dimasukan
    </div>
    @endif

    @if(Session::has('edits'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Berhasil Dirubah
    </div>
    @endif

    @if(Session::has('delete'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Berhasil Dihapus
    </div>
    @endif

    @if(Session::has('failed'))
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Sudah Ada
    </div>
    @endif

    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">Product Categories</h4>
        </div>
        <div class="card-body">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-tittle">Product Categories</h3>
                </div>
                <div class="panel-body">
                    <button type="button" class="btn btn-info " data-toggle="modal"
                        data-target="#tambahdata">
                        <i class="fa fa-plus-square"></i>
                        Add Category
                    </button>
                    <br>
                    <br>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <td>{{$loop->iteration }}</td>
                            <td>{{$item->category_name}}</td>
                            <td class="text-center">
                                <a href="/admin/categories/edit/{{$item->id}}"><button type="button" name="button" class="btn btn-warning btn-sm btn-block">Edit</button></a>
                                <form action="/admin/categories/delete/{{$item->id}}" method="GET">
                                    @csrf
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td class="text-center" colspan="3">
                                <p>Tidak ada data</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/categories/add" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <input name="category_name" type="text" class="form-control"
                                    placeholder="Category name (Cannot add the same category name in the shop!)">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- javascript tambahan --}}
@section('javascript')
<!--Java Script untuk Data Table-->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });

</script>

@endsection