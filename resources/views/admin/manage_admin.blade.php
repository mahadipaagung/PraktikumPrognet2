@extends('admin')
@section('page-contents')
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">Daftar Admin</h4>
        </div>
        <div class="card-body table-responsive">
            <form action="/products/" method="POST">
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
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->phone}}</td>
                        <td>
                            <form action="/products/{{$item->id}}" method="POST">
                                @csrf
                                <button type="submit" name="submit" class="btn btn-primary">edit</button>
                            </form>
                        </td>
                        <td>
                        <form action="/products/{{$item->id}}" method="POST">
                                @csrf
                                <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection