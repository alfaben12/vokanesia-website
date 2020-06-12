@extends('layouts.base')

@section('title', 'Sertifikat')

@section('style')
  <style media="screen">
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
<section class="xs-section-padding blog-single-post-section mt-5 py-0">
		<div class="container my-5">
			<div class="row">
				<div class="col-12 col-lg-8 mb-3 mb-lg-0">
					<div class="single-blog-post post-list format-gallery">
						<div class="post-body p-0">
							<div class="entry-header">
								<div class="entry-content my-0">
									<div class="row my-auto">
										<div class="col-12 mb-lg-0 mb-2">
											<div class="single-case-studies text-center wow fadeInUp">
                        
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-12">
					<div class="single-blog-post post-list format-gallery">
						<div class="post-body py-3">
							<div class="entry-header">
								<div class="entry-content my-3">
									<div class="row my-auto">
										<div class="col-12 mb-lg-5 mb-2">
											<div class="single-case-studie wow fadeInUp">
												<h4 class="small">Tutorial Dasar Laravel</h4>
												<h5>Ryan Ogilvy</h5>
												<hr>
												<i>* Apabila sertifikat gagal ditampilkan, harap muat ulang halaman</i>
												<hr>
												<a href="{{ route("customers.certificate.index") }}" class="btn btn-primary btn-block mt-3">KEMBALI</a>
											</div>
										</div>
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

@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.js" charset="utf-8"></script>
  <script type="text/javascript">
	$(function() {
		var options = {
			pdfOpenParams: { view: 'Fit', scrollbar: '0', toolbar: '0', statusbar: '0', messages: '0', navpanes: '0' },
			fallbackLink: '<p>This browser does not support inline PDFs. Please update your browser</p>'
		};

		PDFObject.embed("{{ $pdf }}", "#pdf", options);
	});
</script>
@endsection
