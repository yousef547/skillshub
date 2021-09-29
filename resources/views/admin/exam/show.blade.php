@extends('admin.layout')

@section('title')
show |Dashbord
@endsection

@section('main')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{$exam->name('en')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('dashboard/exams')}}">Exam</a></li>
                        <li class="breadcrumb-item active">{{$exam->name('en')}}</li>
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
                <div class="col-md-10 offset-md-1 pb-3">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Exam Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-sm">

                            <tbody>
                                <tr>
                                    <th class="w-25">Name (en)</th>
                                    <td>
                                        {{$exam->name('en')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-25">Name (ar)</th>
                                    <td>
                                        {{$exam->name('ar')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-25">Descraption (en)</th>
                                    <td>
                                        {{$exam->desc('en')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-25">Descraption (ar)</th>
                                    <td>
                                        {{$exam->desc('ar')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-25">Skill</th>
                                    <td>
                                        {{$exam->skill->name('en')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-25">image</th>
                                    <td>
                                        <img src='{{asset("uploads/$exam->img")}}' width="50%" height="50%" alt="" sizes="" srcset="">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-25">qusetions no</th>
                                    <td>
                                        {{$exam->questions_no}} qusetions
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-25">difficulty </th>
                                    <td>
                                        {{$exam->qifficulty}} 
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-25">duration mins </th>
                                    <td>
                                        {{$exam->duration_mins}}  M
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-25">active </th>
                                    <td>
                                        @if($exam->active)
                                            <span class="badge bg-success">Active </span> 
                                         @else
                                         <span class="badge bg-danger">Not Active </span>   
                                         @endif 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <a href='{{url("dashboard/exams/show/$exam->id/questions")}}' class="btn btn-ms btn-success">Show Questions</a>
                <a href="{{url()->previous()}}" class="btn btn-ms btn-dark">Back</a>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection