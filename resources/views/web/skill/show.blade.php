@extends('web.layout')

@section('title')
 skill | {{$skill->name()}}
@endsection

@section('contect')

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/page-background.jpg') }})"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.html">{{__('web.home')}}</a></li>
							<li><a href="category.html">{{{$skill->cat->name()}}}</a></li>
							<li>{{$skill->name()}}</li>
						</ul>
						<h1 class="white-text">{{$skill->name()}}</h1>

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
					<div id="main" class="col-md-12">

						<!-- row -->
						<div class="row">
							<!-- single exam -->
							@foreach($skill->exams as $oneSkill)
							<div class="col-md-3">
								<div class="single-blog">
									<div class="blog-img">
										<a href="{{url("exam/show/$oneSkill->id")}}">
											<img src="{{asset("/uploads/$oneSkill->img")}}" alt="">
										</a>
									</div>
									<h4><a href="{{url("exam/show/$oneSkill->id")}}">{{$oneSkill->name()}}</a></h4>
									<div class="blog-meta">
                                        <span>{{ Carbon\Carbon::parse($oneSkill->created_at)->format('d M, Y')}}</span>
										<div class="pull-right">
											<span class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{$skill->getStudentCount()}}</a></span>
										</div>
									</div>
								</div>
							</div>
							<!-- /single exam -->
							@endforeach
						

						</div>
						<!-- /row -->

						<!-- row -->
						<div class="row">

							<!-- pagination 
							<div class="col-md-12">
								<div class="post-pagination">
									<a href="#" class="pagination-back pull-left">Back</a>
									<ul class="pages">
										<li class="active">1</li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
									</ul>
									<a href="#" class="pagination-next pull-right">Next</a>
								</div>
							</div>
							 pagination -->

						</div>
						<!-- /row -->
					</div>
					<!-- /main blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

@endsection
