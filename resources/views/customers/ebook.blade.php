@extends('layouts.base')

@section('style')
<link rel="stylesheet" href="{{ asset('css/fontawesome-stars.css') }}">
@endsection

@section('body')
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
												<!-- <div style="z-index : 1001;overflow: scroll; position : absolute; left: 0px; top : 0px; width : 100%; height : 100vh;pointer-events:inherit"></div> -->
												<div id="pdf" style="position: relative"></div>
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
												<h4 class="small">{{$data->name}}</h4>
												<h5>{{$data->userDetails()->nama}}</h5>
												<hr>
												<p>Beri Rating:</p>
												<select id="example">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
												<hr>
												<i>* Apabila ebook gagal ditampilkan, harap muat ulang halaman</i>
												<hr>
												<a href="#" class="btn btn-primary btn-block mt-3">KEMBALI</a>
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
<script src="{{ asset('js/jquery.barrating.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/epubjs/dist/epub.min.js"></script>

	<script type="text/javascript">
	$(function() {

		
		$('#example').barrating({
			theme: 'fontawesome-stars',
			onSelect: function(value, text, event){
				alert(value)
			},
		});
		// var options = {
		// 	pdfOpenParams: { view: 'Fit', scrollbar: '0', toolbar: '0', statusbar: '0', messages: '0', navpanes: '0' },
		// 	fallbackLink: '<p>This browser does not support inline PDFs. Please update your browser</p>'
		// };

		// PDFObject.embed("{{Voyager::image($data->pdfUrl())}}", "#pdf", options);
		var urlPdf = "{{Voyager::image($data->pdfUrl())}}"
		var book = ePub(urlPdf);
		var rendition = book.renderTo("pdf", {
			manager: "continuous",
        	flow: "scrolled",
        	width: "100%",
			height: "100vh"
		});
  		var displayed = rendition.display();
		rendition.themes.default({
        	'body': {
                '-webkit-touch-callout': 'none', /* iOS Safari */
                '-webkit-user-select': 'none', /* Safari */
                '-khtml-user-select': 'none', /* Konqueror HTML */
                '-moz-user-select': 'none', /* Firefox */
                '-ms-user-select': 'none', /* Internet Explorer/Edge */
                'user-select': 'none',
            }
        });

		rendition.on('rendered', function(e, i){
			i.document.documentElement.addEventListener("contextmenu", function(cfiRange, contents) {
				console.log(cfiRange);
			})
		})
	});
</script>
@endsection