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
      <h3 class="card-title ">Edit Admin</h4>
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
                <form action="{{ route('admin.edit.submit') }}" method="POST" class="form">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" name="username" value="{{$adminedit->username}}"  class="form-control" >
                          <input type="hidden" name="id" value="{{$adminedit->id}}">
                        </div>
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" value="{{$adminedit->password}}" class="form-control" min="1">
                        </div>
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" value="{{$adminedit->name}}"  class="form-control" >
                        </div>
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="number" name="phone" value="{{$adminedit->phone}}"  class="form-control" min="1">
                        </div>
                      </div>
                      <div class=" bmd-form-group">
                        <label class="col-sm-2 col-form-label">Profile Image</label>
                        <div class="col-sm-10"> 
                          <input type="file" name="profile" value="{{$adminedit->profile_image}}"  class="form-control" min="1">
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success pull-right" onclick="return confirm('Are you sure you want to edit this admin?');">Save Edited Data</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
