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
 <div class="content">
  <div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"> Edit Product</h3>
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
                  <form action="{{route('product.edit',['id'=>$product->id])}}" method="POST" class="form">
                        @csrf
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Product Name</label>
                                    <input type="text" name="product_name" value="{{$product->product_name}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">price</label>
                                    <input type="text" name="price" value="{{$product->price}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Description</label>
                                    <input type="text" name="description" value="{{$product->description}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Product Rate</label>
                                    <input type="text" name="product_rate" value="{{$product->product_rate}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Stock</label>
                                    <input type="text" name="stock" value="{{$product->stock}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Weight</label>
                                    <input type="text" name="weight" value="{{$product->weight}}"  class="form-control" >
                                </div>
                            </div>
                        </div>
                        
                        <input type="submit" value="Change" class="btn btn-success pull-right">
                    </form>
                </div>
              </div>
            </div>
            
            {{-- producImage --}}
             <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Product Images</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                      <form action="{{route('product.add_image',['id'=>$product->id])}}" method="POST" enctype="multipart/form-data" class="form">
                        @csrf
                         <div class="row">
                            <div class="col-md-12">
                              <div class="form-group bmd-form-group form-file-upload form-file-multiple">
                                <input type="file" multiple="" name="product_images[]" class="inputFileHidden">
                                <input type="submit" name="submit" value="Add Image" class="btn btn-success pull-right">
                              </div>
                            </div>
                         </div>  
                      </form>
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
                            <img src="{{asset('storage/img/gambarproduk/'.$i->image_name)}}" style="width:260px;" alt="">
                           
                          </td>
                          <td class="td-actions text-left" >
                            <form style="display:inline-block;" action="{{route('product.delete_image',['id'=>$i->id])}}" method="post">
                              
                                    @csrf
                                    @method('DELETE')
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o">  Delete</i>
                                  </button>
                                </form>
                          </td>
                        </tr>
                        @endforeach
                       @endif
                      </tbody>
                     </table>
                      {{$image->links()}}
                    </div>
                  </div>
                </div>
              </div>
            {{-- productImage end --}}

             {{-- product Category --}}
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Product Categories</h4>
                  <p class="card-category"> </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form action="{{route('product.add_cat',['id'=>$product->id])}}" method="post"  class="form">
                      @csrf
                      <div class="form-group">
                        <select  class="form-control" name="product_category" data-style=" btn btn-link">
                          @if ($product_categories->isEmpty())
                              <option disabled>Category Product</option>
                          @else
                               <option selected disabled>-- Category Product --</option>
                              @foreach ($product_categories as $pc)
                                <option value="{{$pc->id}}">{{$pc->category_name}}</option>
                              @endforeach
                          @endif
                        </select>
                        <br>
                        <input type="submit" name="submit" value="Add Category" class="btn btn-success pull-right">
                      </div>
                    </form>

                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                          Name Category
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                       @if ($product_category_details->isEmpty())
                           
                       @else
                        @foreach ($product_category_details as $det)
                            
                        <tr>
                          <td>
                          {{$loop->iteration}}
                          </td>
                          <td>
                            
                            {{$det->product_categories->category_name}}
                          </td>
                          <td class="td-actions text-left" >
                            <form style="display:inline-block;" action="{{route('product.delete_image',['id'=>$i->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o">  Delete</i>
                                  </button>
                                </form>
                          </td>
                        </tr>
                          @endforeach
                       @endif
                      </tbody>
                    </table>
                  </div>
                  {{$product_category_details->links()}}
                </div>
              </div>
            </div>
            {{-- product Category  end--}}


            {{-- product review --}}
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
                          <td class="td-actions text-left" >
                            <a href="{{route('response.add_response',$review)}}"  rel="tooltip" title="Review Product" class="btn btn-primary btn-sm">
                              <span class="lnr lnr-pencil"> Add Response</span>
                                </a>
                          </td>
                        </tr>
                          @endforeach
                       @endif
                      </tbody>
                    </table>
                  </div>
                  {{$product_review->links()}}
                </div>
              </div>
            </div>
            {{-- product review--}}

            {{-- Product Discount --}}
              <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">Discount</h4>
                 <a href="{{route('discount.add',['id'=>$product->id])}}" class="btn btn-success"><i class="fa fa-plus"></i> Add Discount</a>
                    </li>
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
                                
                                <form style="display:inline-block;" action="{{route('discount.destroy',['id'=>$item->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o">  Delete</i>
                                  </button>
                                </form>
                                <a href="{{route('discount.edit',$item->id)}}"  rel="tooltip" title="Review Product" class="btn btn-primary btn-sm">
                                  <span class="lnr lnr-pencil"> Edit</span>
                                </a>
                            
                              </td>
                          </tr>
                          {{$discount->links()}}
                        @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                    @endif   
                </div>
              </div>
            </div>
            
            {{-- Product Discount --}}
          </div>


        </div>
      </div>
      
@endsection
