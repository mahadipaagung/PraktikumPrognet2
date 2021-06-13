@extends('admin')
@section('page-contents')
<style>
.row{
  margin: 10px;
}

.bmd-label-floating{
  margin-bottom: 5px;
}
</style>
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

@if(Session::has('failed'))
<div class="alert alert-warning d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#check-circle-fill"/></svg>
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        Data Tidak Ditambah
    </div>
</div>
@endif

@if(Session::has('failed1'))
<div class="alert alert-warning d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#check-circle-fill"/></svg>
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        Data Tidak Diedit
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

<div class="col-md-12">
  <div class="card">
    <div class="card-header card-header-primary">
      <h3 class="card-title ">Edit Product</h4>
    </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="panel-body">
              <div class="card-header card-header-primary>
                <h4 class="card-title> </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                  </div>
                </div>
                <form action="/admin/products/edit/edit" method="POST" class="form">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Product Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="product_name" value="{{$product->product_name}}"  class="form-control" >
                          <input type="hidden" name="product_id" value="{{$product->id}}">
                        </div>
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                          <input type="number" name="price" value="{{$product->price}}" class="form-control" min="1">
                        </div>
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <input type="text" name="description" value="{{$product->description}}"  class="form-control" >
                        </div>
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-10">
                          <input type="number" name="stock" value="{{$product->stock}}"  class="form-control" min="1">
                        </div>
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-10"> 
                          <input type="number" name="weight" value="{{$product->weight}}"  class="form-control" min="1">
                        </div>
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10"> 
                          @php
                            $checkedcat=0;
                            $status=0;
                          @endphp

                          @foreach($product_categories as $category)
                            @foreach($product_category_details as $pcd)
                              @php
                                $status=0;
                                if($category->id == $pcd->category_id){
                                  $status=1;
                                  break;
                                }
                              @endphp
                            @endforeach
                            @if($status==1)
                            <br>
                            <input type="checkbox" name="cat[]" alt="checkbox" value="{{$category->id}}" checked>{{$category->category_name}}
                            @else
                            <br>
                            <input type="checkbox" name="cat[]" alt="checkbox" value="{{$category->id}}">{{$category->category_name}}
                            @endif
                            
                          @endforeach
                          <br>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success pull-right" onclick="return confirm('Are you sure you want to edit this product?');">Save Edited Data</button>
                </form>
              </div>
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Product Images</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        Image
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                      @if ($image->isEmpty())
                        <tr>
                          <td>
                            Gambar kosong
                          </td>
                        </tr>
                      @else
                        @foreach ($image as $i)
                        <tr>
                          <td>
                            {{$loop->iteration}}
                          </td>
                          <td>
                            <img src="/uploads/product_images/{{$i->image_name}}" style="width:300px;" alt="{{$i->image_name}}">     
                          </td>
                          <td class="td-actions text-left">
                            <a href="/admin/products/delete/gambar/{{$i->id}}"><button type="button" name="submit" class="btn btn-danger btn-lg btn-block" onclick="return confirm('Are you sure you want to delete this image?');">Delete</button></a>
                          </td>
                        </tr>
                        @endforeach
                      @endif
                    </tbody>
                    </table>
                  </div>
                </div>
                <div class="m-4">
                  <form action="/admin/products/add/gambar/" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$product->id}}" name="product_id">
                    <input type="file" multiple="" name="product_images[]" class="inputFileHidden form-control pull-right" required><br><br>
                    <button type="submit" name="submit" class="btn btn-success pull-right">Add Image</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Product Review</h4>
                <p class="card-category"> </p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        User Name
                      </th>
                      <th>
                        Rate
                      </th>
                      <th>
                        Comment
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                      @if ($product_review->isEmpty())
                        <tr>
                          <td>
                            <p>Data is empty</p>
                          </td>
                        </tr>
                      @else
                        @foreach ($product_review as $review)   
                        <tr>
                          <td>
                          {{$loop->iteration}}
                          </td>
                          <td>
                            {{$review->user->name}}
                          </td>
                          <td>
                            {{$review->rate}}
                          </td>
                          <td>
                            {{$review->content}}
                          </td>
                          <td>
                            <a href="/admin/products/delete/comment/{{$review->id}}"><button type="button" name="submit" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Are you sure you want to delete this review?');">Delete</button></a>
                          </td>
                        </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Discount</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                @if ($discount->isEmpty())
                  <tr>
                  <td>
                    <p>Data is empty</p>
                  </td>
                </tr>
                @else
                  <table class="table">
                    <thead class=" text-info">
                      <th>
                        ID
                      </th>
                      <th>
                        Product
                      </th>
                      <th>
                        Precentage
                      </th>
                      <th>
                        Start
                      </th>
                      <th>
                        End
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>   
                      @foreach ($discount as $item)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$item->product->product_name}}</td>
                          <td>{{$item->percentage}}</td>
                          <td>{{$item->start}}</td>
                          <td>{{$item->end}}</td>
                          <td class="td-actions text-left">
                            <a href="/admin/discount/edit/{{$item->id}}"><button type="button" name="button" class="btn btn-warning btn-sm btn-block">Edit</button></a>
                            <br>
                            <form action="/admin/discount/delete/{{$item->id}}" method="GET">
                                @csrf
                                <button type="submit" name="submit" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Are you sure you want to delete this discount?');">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                @endif  
                </div> 
              </div>
              <div class="m-4">
                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#tambahdata">
                  <i class="fa fa-plus-square"></i>
                  Add Discount
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Discount</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="/admin/discount/add" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group bmd-form-group">
            <label class="col-sm-2 col-form-label">Percentage</label>
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="number" name="percentage"  step="0.01" min="0" max="99" value=""  class="form-control" >
        </div>
        <div class="form-group bmd-form-group">
          <label class="col-sm-2 col-form-label">Start</label>
          <input type="date" name="start" min="" class="form-control" >
        </div>
          <div class="form-group bmd-form-group">
            <label class="col-sm-2 col-form-label">End</label>
            <input type="date" name="end" min="" class="form-control" >
          </div>
        <div class="modal-body">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  var today = new Date().toISOString().split('T')[0];
  document.getElementsByName("start")[0].setAttribute('min', today);
  document.getElementsByName("end")[0].setAttribute('min', today);
</script>
@endsection
