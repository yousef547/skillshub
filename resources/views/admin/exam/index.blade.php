@extends('admin.layout')

@section('title')
Exam |Dashbord
@endsection

@section('main')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('admin.inc.massage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Exam</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Exam</li>
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
                            <h3 class="card-title">All Exams</h3>

                            <div class="card-tools">
                                <a href='{{url("dashboard/exams/create")}}' class="btn btn-sm btn-primary">Add New </a>
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
                                        <th>Image</th>
                                        <th>skill name</th>
                                        <th>Questions no.</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exams as $exam)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="name_en">{{$exam->name('en')}}</td>
                                        <td class="name_ar">{{$exam->name('ar')}}</td>
                                        <td><img width="50px" src='{{asset("uploads/$exam->img")}}' /></td>
                                        <td>{{$exam->skill->name('en')}}</td>
                                        <td>{{$exam->questions_no}}</td>
                                        <td>
                                            @if($exam->active)
                                            <span class="badge bg-success"><a href='{{url("dashboard/exams/toggal/$exam->id")}}'>Active</a></span>
                                            <!--  -->
                                            @else
                                            <span class="badge bg-danger"><a href='{{url("dashboard/exams/toggal/$exam->id")}}'>Not Active</a> </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href='{{url("dashboard/exams/show/$exam->id")}}' class="btn btn-ms btn-primary edit_btn">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href='{{url("dashboard/exams/show/$exam->id/questions")}}' class="btn btn-ms btn-dark edit_btn">
                                                <i class="fas fa-question"></i>
                                            </a>
                                            <a href='{{url("dashboard/exams/edit/$exam->id")}}' class="btn btn-ms btn-info edit_btn">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href='{{url("dashboard/exams/delete/$exam->id")}}' class="btn btn-ms btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{$exams->links()}}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    @endsection