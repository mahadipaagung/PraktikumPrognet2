@extends('admin')
@section('page-contents')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Add Admin</h4>
    </div>
    <div class="card-body">
        <form action="/admin/products/add" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="m-3">
                {{-- Nama admin --}}

                    <label class="form-label"><strong>Product Name<strong></label>
                    <input name="product_name" type="text" class="form-control" placeholder="Product name" required>

                {{-- username --}}

                    <label class="form-label"><strong>Price<strong></label>
                    <input name="price" type="number" class="form-control" placeholder="Product price" min="1" required>

                {{-- Description --}}

                    <label class="form-label"><strong>Description<strong></label>
                    <input name="description" type="text" class="form-control" placeholder="Product description" required>

                {{-- Stock --}}

                <label class="form-label"><strong>Stock<strong></label>
                <input name="stock" type="number" class="form-control" placeholder="Product stock" min="1" required>

                {{-- Weight --}}

                <label class="form-label"><strong>Weight<strong></label>
                <input name="weight" type="number" class="form-control" placeholder="Product weight" min="1" required>

                {{-- Category--}}

                <label class="form-label"><strong>Category<strong></label>
                @foreach($categories as $category)
                    <br>
                    <input type="checkbox" name="cat[]" alt="checkbox" value="{{$category->id}}">{{$category->category_name}}
                @endforeach
                <br>
                {{-- Product images --}}
                <label class="form-label"><strong>Product Images<strong></label>
                <input type="file" name="product_images[]" multiple="" accept=".jpeg,.jpg,.png,.gif" class="form-control">

                <a href="/admin/products/">
                    <button type="button" class="btn btn-danger">
                        Cancel
                    </button>
                </a>
                <button type="submit" class="btn btn-info">Save</button>
        </form>
    </div>
</div>

@endsection