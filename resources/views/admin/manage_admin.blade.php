@extends('admin')
@section('page-contents')
    @if(Session::has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Berhasil Dimasukan
        </div>
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
    </div>
    @endif

    @if(Session::has('delete'))
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Data Berhasil Dihapus
        </div>
    </div>
    @endif

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">Daftar Admin</h4>
        </div>
        <div class="card-body table-responsive">
            <form action="/admin/manage-admin/add" method="GET">
                @csrf
                <button type="submit" name="submit" class="btn btn-info">
                <i class="fa fa-plus-square mr-2"></i> tambah data</button>
            </form>
            <table class="table table-hover">
            <thead class="text-warning">
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach ($listAdmin as $item)
                    @if($item->id!=1)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->phone}}</td>
                        <td>
                            <form action="/admin/manage-admin/{{$item->id}}" method="POST">
                                @csrf
                                <button type="submit" name="submit" class="btn btn-primary">edit</button>
                            </form>
                        </td>
                        <td>
                        <form action="/admin/manage-admin/delete/{{$item->id}}" method="GET">
                                @csrf
                                <button type="submit" name="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection