@extends('admin.layout')

@section('title')
Catagories |Dashbord
@endsection

@section('main')
 
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   @include('admin.inc.massage')
   @include('admin.inc.error')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Catagories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Catagories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card">
          <div class="card-header">
                <h3 class="card-title">All Catagory</h3>

                <div class="card-tools">
                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div> -->
                  <button data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-primary">Add New </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name (en)</th>
                      <th>Name(ar)</th>
                      <th>Active</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($cats as $cat)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="name_en">{{$cat->name('en')}}</td>
                                <td class="name_ar">{{$cat->name('ar')}}</td>
                                <td>
                                    @if($cat->active)
                                        <span class="badge bg-success"><a href='{{url("dashboard/catagories/toggal/$cat->id")}}'>Active</a></span>
                                        <!--  -->
                                    @else
                                        <span class="badge bg-danger"><a href='{{url("dashboard/catagories/toggal/$cat->id")}}'>Not Active</a> </span>
                                    @endif
                                </td>
                                <td>
                                    <button data-toggle="modal" data-id="{{$cat->id}}" data-name-ar="{{$cat->name('ar')}}" data-name-en="{{$cat->name('en')}}" data-target="#modal-edit" class="btn btn-ms btn-info edit_btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href='{{url("dashboard/catagories/delete/$cat->id")}}'  class="btn btn-ms btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{$cats->links()}}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

      <div class="modal fade show" id="modal-info" style="padding-right: 16px; display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{url('dashboard/catagories/store')}}" id="add-form">
            @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name (En)</label>
                    <input type="text" class="form-control" name="name_en" id="exampleInputEmail1" placeholder="english">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Name (Ar)</label>
                    <input type="text" class="form-control" name="name_ar" id="exampleInputPassword1" placeholder="عربي">
                  </div>
                </div>
                <!-- /.card-body -->

              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" form="add-form" type="button" class="btn btn-outline-light">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      
      <div class="modal fade show" id="modal-edit" style="padding-right: 16px; display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{url('dashboard/catagories/updata')}}" id="edit-form">
            @csrf
            <input type="hidden" name="id" id="edit-form-id">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name (En)</label>
                    <input type="text" class="form-control" id="edit-form-en" name="name_en" id="exampleInputEmail1" placeholder="english">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Name (Ar)</label>
                    <input type="text" class="form-control" name="name_ar" id="edit-form-ar" id="exampleInputPassword1" placeholder="عربي">
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- href='{{url("dashboard/catagories/updata")}}' -->
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" form="edit-form" type="button" class="btn btn-outline-light">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection

@section('script') 
<script>
   $('.edit_btn').click(function(){
     let id = $(this).attr('data-id');
     let nameEn = $(this).attr('data-name-en');
     let nameAr = $(this).attr('data-name-ar');
     $('#edit-form-id').val(id);
     $('#edit-form-en').val(nameEn);
     $('#edit-form-ar').val(nameAr);

    //  console.log(id + " " + nameEn + " " + nameAr)
   })
</script>

@endsection







