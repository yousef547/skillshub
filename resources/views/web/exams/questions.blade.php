@extends('web.layout')

@section('title')
Exam Questions : {{$exams->name()}}
@endsection
@section('styles')
<link href="{{asset('web/css/TimeCircles.css')}}" rel="stylesheet">
@endsection
@section('contect')

<!-- Hero-area -->
<div class="hero-area section">

  <!-- Backgound Image -->
  <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/blog-post-background.jpg') }})"></div>
  <!-- /Backgound Image -->

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1 text-center">
        <ul class="hero-area-tree">
          <li><a href="index.html">{{__('web.home')}}</a></li>
          <li><a href="{{url("/skill/show/".$exams->skill->cat->id)}}">{{$exams->skill->cat->name()}}</a></li>
          <li><a href="{{url("/exam/show/".$exams->skill->id)}}">{{$exams->skill->name()}}</a></li>
          <li>{{$exams->name()}}</li>
        </ul>
        <h1 class="white-text">{{$exams->name()}}</h1>
        <ul class="blog-post-meta">
          <li>18 Oct, 2017</li>
          <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{$exams->users()->count()}}</a></li>
        </ul>
      </div>
    </div>
  </div>

</div>
<!-- /Hero-area -->

<!-- Blog -->
<div id="blog" class="section">

  <!-- container -->
  <div class="container">

    <!-- row -->
    <div class="row">

      <!-- main blog -->
      <div id="main" class="col-md-9">
        <form id="exam-submit-form" action='{{url("exam/submit/{$exams->id}")}}' method="POST">
          @csrf
        </form>
        <!-- blog post -->
        <div class="blog-post mb-5">
          <p>
            @foreach($exams->questions as $key =>$question)
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">{{$key + 1 }}- {{$question->title}}</h3>
            </div>
            <div class="panel-body">
              <div class="radio">
                <label>
                  <input type="radio" name="answers[{{$question->id}}]"  value="1" form="exam-submit-form">
                  {{$question->option_1}}
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="answers[{{$question->id}}]"  value="2" form="exam-submit-form">
                  {{$question->option_2}}
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="answers[{{$question->id}}]"  value="3" form="exam-submit-form">
                  {{$question->option_3}}
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="answers[{{$question->id}}]"  value="4" form="exam-submit-form">
                  {{$question->option_4}}
                </label>
              </div>
            </div>
          </div>
          @endforeach

          </p>
        </div>
        <!-- /blog post -->

        <div>
          <button type="submit" form="exam-submit-form" class="main-button icon-button pull-left">Submit</button>
          <button class="main-button icon-button btn-danger pull-left ml-sm">Cancel</button>
        </div>
      </div>
      <!-- /main blog -->

      <!-- aside blog -->
      <div id="aside" class="col-md-3">

        <!-- exam details widget -->
        <ul class="list-group">
          <li class="list-group-item">{{__('web.skill')}}: {{$exams->skill->name()}}</li>
          <li class="list-group-item">{{__('web.questions')}}: {{$exams->questions_no}}</li>
          <li class="list-group-item">{{__('web.duration')}}: {{$exams->duration_mins}} mins</li>
          <li class="list-group-item">{{__('web.difficulty')}}:
            @for($i=1;$i<=$exams->qifficulty;$i++)
              <i class="fa fa-star"></i>
              @endfor

              @for($i=1;$i<=(5 - $exams->qifficulty);$i++)
                <i class="fa fa-star-o"></i>
                @endfor

          </li>
        </ul>
        <!-- <div class="durationCountDown" data-timer="10"></div> -->
        <!-- /exam details widget -->
        <div class="durationCountDown" data-timer="{{$exams->duration_mins * 60}}"></div>
      </div>
      <!-- /aside blog -->

    </div>
    <!-- row -->

  </div>
  <!-- container -->

</div>
<!-- /Blog -->

@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>
<script>
	$(".durationCountDown").TimeCircles({
    time: {
      Days:{
        show: false
      }
    },
    count_past_zero:false
  }).addListener(function(unit, value, total){
    if(total <= 0) {
      $('#exam-submit-form').submit();
    }
  }); 

</script>
@endsection