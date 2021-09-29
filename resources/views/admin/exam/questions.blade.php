@extends('admin.layout')

@section('title')
qusetions | Dashbord
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
                        <li class="breadcrumb-item"><a href='{{url("dashboard/exams/show/$exam->id")}}'>{{$exam->name('en')}}</a></li>
                        <li class="breadcrumb-item active">Questions</li>
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
                <div class="col-md-12 pb-3">
                    <div class="card ">
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Options</th>
                                        <th>Right ans</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exam->questions as $question)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$question->title}}</td>
                                        <td>
                                            {{$question->option_1}} |<br>
                                            {{$question->option_2}} |<br>
                                            {{$question->option_3}} |<br>
                                            {{$question->option_4}}
                                        </td>
                                        <td>
                                            {{$question->right_ans}}
                                        </td>
                                        <td>
                                            <a href='{{url("dashboard/exams/edit-questions/$exam->id/$question->id")}}' class="btn btn-ms btn-info edit_btn">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href='{{url("dashboard/skills/delete/$question->id")}}' class="btn btn-ms btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection