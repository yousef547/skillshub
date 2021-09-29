@extends('web.layout')

@section('title')
show Exam : {{$exams->name()}}
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
							<li><a href="category.html">{{$exams->skill->cat->name()}}</a></li>
							<li><a href="category.html">{{$exams->skill->name()}}</a></li>
							<li>{{$exams->name()}}</li>
						</ul>
						<h1 class="white-text">{{$exams->name()}}</h1>
						<ul class="blog-post-meta">
							<li>{{ Carbon\Carbon::parse($exams->created_at)->format('d M, Y')}}</li>
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
						@include('web.inc.massage');					<!-- blog post -->
						<div class="blog-post mb-5">
							<p>
                                {{$exams->desc()}}
                            </p>       
						</div>
						<!-- /blog post -->
                        
                        <div>
								@if( $canEnter)
								<form method="POSt" action='{{url("/exam/start/$exams->id")}}'>
									@csrf
									<button type="submit" class="main-button icon-button pull-left">{{__('web.startExamBtn')}}</button>
								</form>
								@endif 
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
						<!-- /exam details widget -->

						

					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

@endsection

