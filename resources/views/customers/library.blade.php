@extends('layouts.base')

@section('style')
	<style media="screen">
	img {
		max-height: 150px;
	}
	.list-group-2 {
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
		padding-left: 0;
		margin-bottom: 0;
	}
	.widget .list-group-2 li:not(:last-child){
		margin-bottom: 15px;
	}
	.list-group-2>li:not(:last-child) {
		margin-bottom: 10px;
	}
	.widget .list-group-2 li {
		font-size: 0.9333333333rem;
	}
	.list-group-2>li {
		font-size: 1.0666666667rem;
		color: #999999;
	}
	.widget .list-group-2 li a {
		-webkit-transition: all 0.4s ease;
		-o-transition: all 0.4s ease;
		transition: all 0.4s ease;
	}
	.widget .list-group-2 li a, .widget .list-group-2 li span {
		color: #919191;
		padding: 1.2rem 2.1rem;
	}
	.widget .list-group-2 .menu-active a {
		color: #0c5adb;
		font-weight: bolder;
	}
	.menu-before {
		-webkit-box-align: stretch;
		align-items: stretch;
		box-sizing: border-box;
		display: flex;
		flex-direction: column;
		-webkit-box-flex: 0;
		flex-grow: 0;
		flex-shrink: 0;
		min-height: 0pt;
		min-width: 0pt;
		user-select: none;
		position: absolute;
		height: 100%;
		width: 0.4rem;
		top: 0px;
		left: 0px;
		border-top-left-radius: 0.2rem;
		border-bottom-left-radius: 0.2rem;
		background-color: rgb(19, 95, 220);
		border-width: 0pt;
		border-style: solid;
		margin: 0pt;
		padding: 0pt;
	}
	.menu-active {
		-webkit-box-align: stretch;
		align-items: stretch;
		box-sizing: border-box;
		display: flex;
		flex-direction: column;
		-webkit-box-flex: 0;
		flex-grow: 0;
		flex-shrink: 0;
		position: relative;
		min-height: 0pt;
		min-width: 0pt;
		user-select: none;
		margin: 0pt;
		font-weight: bolder;
	}
	</style>
@endsection

@section('body')
	@include('layouts.customer_header')
	<section class="xs-section-padding blog-single-post-section pt-0">
		<div class="container">
			<div class="row">
				<div class="col-12 d-md-none d-sm-block mb-3">
					<select class="form-control" onchange="location = this.value;">
						<option value="customer-library.html">Semua</option>
						<option value="customer-library.html">Video</option>
						<option value="customer-library.html">E-Book</option>
					</select>
				</div>
				<div class="col-lg-4 d-md-block d-none">
					<div class="widget widget-categories">
						<ul class="list-group-2">
							<li class="menu-active">
								<div class="menu-before"></div>
								<a href="#">Semua</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-8 col-12">
					<div class="single-blog-post post-list format-gallery">
						<div class="post-body py-3">
							<div class="entry-header">
								<div class="entry-content my-3">
									<div class="row my-auto">
										@foreach($data as $row)
											<div class="col-12 col-lg-6 mb-lg-5 mb-2">
												<a href="{{$row->type == 'video'  ?  route('customers.video.kelas' , ['video' => $row->produk_id]) : route('customers.pdf.read' , ['pdf' => $row->produk_id])}}">
												<div class="single-case-studies text-center wow fadeInUp">
													<div class="image">
														<img src="{{Voyager::image($row->produkDetails()->cover)}}" alt="">
													</div>
													<div class="case-body py-0">
														<div class="row">
															<div class="col-12 text-center mt-3">
																<h4 class="small mb-0">{{$row->produkDetails()->userDetails()->name}}</h4>
																<span>{{$row->produkDetails()->name}}</span>
																<p style="font-weight: bolder">{{$row->type == 'video' ? 'Video' : 'E-book'}}</p>
															</div>
														</div>
													</div>
												</div>
												</a>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
