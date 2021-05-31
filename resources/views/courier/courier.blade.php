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

@if(Session::has('failed'))
<div class="alert alert-warning d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        Data Sudah Ada
    </div>
</div>
@endif

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-tittle">Courier</h3>
    </div>
    <div class="panel-body">
        {{-- ------------------------------------------TOMBOL TAMBAH DATA---------------------------------------- --}}
        <button type="button" class="btn btn-info " data-toggle="modal" data-target="#tambahdata">
            <i class="fa fa-plus-square"></i>
            Tambah Data
        </button>
        {{-- ------------------------------------------Section & Tambah data---------------------------------------- --}}
        <br>
        <br>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Courier</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$item->courier}}</td>
                    <td class="text-center">
                        {{-- TOMBOL DELETE DAN EDIT --}}
                        <form action="/courier/{{$item->id}}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}

                            {{-- TOMBOL EDIT --}}
                            <a href="/courier/{{$item->id}}/edit" class="btn btn-primary">Edit
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg>
                            </a>

                            {{-- TOMBOL DELETE --}}
                            <button type="submit" name="submit" class="btn btn-danger">Delete
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button>
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


        <!--------------------------------------- Modal Tambah data--------------------------------------------- -->
        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/courier" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            {{-- Nama courier --}}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Kurir</label>
                                <div class="col-sm-10">
                                    <input name="courier" type="text" class="form-control"
                                        placeholder="Nama kurir yang ingin ditambahkan">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            {{-- kode courier --}}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">kode kurir</label>
                                <div class="col-sm-10">
                                    <input name="courierkode" type="text" class="form-control"
                                        placeholder="kode kurir yang ingin ditambahkan">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
