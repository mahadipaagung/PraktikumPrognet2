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
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">Product</h4>
        </div>
        <div class="card-body">
            <div class="panel">
                <div class="panel-body">
                    <a href="/admin/products/baru"><button type="button" class="btn btn-info ">
                        <i class="fa fa-plus-square"></i>
                        Add Product
                    </button></a>
                    <br>
                    <br>
                </div>
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Product Rate</th>
                    <th>Stock</th>
                    <th>Weight</th>
                    <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($products as $product)
                    <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$product->product_name}}</td>
                    <td>Rp{{number_format($product->price)}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->product_rate}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->weight}}</td>
                    <td class="text-center">
                        <a href="/admin/products/edit/{{$product->id}}"><button type="button" name="button" class="btn btn-warning btn-lg btn-block">Edit</button></a>
                        <form action="/admin/products/delete/{{$product->id}}" method="GET">
                            @csrf
                            <button type="submit" name="submit" class="btn btn-danger btn-lg btn-block" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                        </form>
                    </td>
                    </tr>
                @empty
                    <tr>
                    <td class="text-center" colspan="3">
                        <p>No product yet</p>
                    </td>
                    </tr>
                @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>
   
@endsection

@section('javascript')
<!--Java Script untuk Data Table-->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
@endsection

<!-- @section('script')
<script>
    $(document).ready(function(e){
        $('#bacot').click(function(e){
            var index = $(".deletebtn").index(this);
            var indexbaru = index + 1;
            var product_id = $('.delete'+indexbaru).val();
            console.log(product_id);
            swal({
                title: "Delete this product?",
                text: "You will not be able to undo this action!",
                icon: "warning",
                buttons: [
                'No!',
                'Yes!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/updatecart/'+user_id: $('.userid'+indexbaru).val(),
                    method: 'get',
                    data: {
                        
                    },
                    success: function(result){
                        swal("Product Deleted", "The product is removed from your store!", "success");
                    }
                });
                } else {
                swal("Product Status", "Your product is still in shop!", "warning");
                }
            });
        });
    });
</script>
@endsection -->