@extends('layouts.base')

@section('body')
@include('layouts.customer_header')
	<section class="xs-section-padding blog-single-post-section pt-0">
		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<form class="xs-from" action="{{route('customers.messages.create')}}" method="post">
						@csrf
						<div class="modal-header">
							<h5 class="modal-title" id="addLabel">Create New Message</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<input type="text" class="form-control" name="judul" placeholder="Masukkan judul pesan" required>
							</div>
							<div class="form-group">
								<textarea name="message" class="form-control" placeholder="Masukkan isi permasalahan"></textarea>
							</div>
							<div class="form-group">
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-primary">Kirim</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		@if($data->count() > 0)
		@foreach($data as $row)
		<div class="modal fade" id="check-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="checkLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<form class="xs-from" action="{{route('customers.messages.replay', ['id' => $row->id])}}" method="post">
						@csrf
						<div class="modal-header">
							<h5 class="modal-title" id="checkLabel">Reply Messages {{$row->ticket_no}}</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<textarea name="replay" class="form-control" placeholder="Masukkan jawaban"></textarea>
							</div>
							<div class="col-12">
								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Tanggal</th>
												<th>Pukul</th>
												<th>Pengirim</th>
												<th>Tanggapan</th>
											</tr>
											<tbody>
												<tr>
													<td>{{$row->created_at->todatestring()}}</td>
													<td>{{$row->created_at->totimestring()}}</td>
													<td>Saya</td>
													<td>{!! $row->message !!}</td>
												</tr>
												@foreach($row->ticketMessages() as $replay)
												<tr>
													<td>{{$replay->created_at->todatestring()}}</td>
													<td>{{$replay->created_at->totimestring()}}</td>
													<td>{{$replay->customer_id ? 'Saya' : 'Admin'}}</td>
													<td>{!!$replay->reply!!}</td>
												</tr>
												@endforeach
											</tbody>
										</thead>
									</table>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-primary">Kirim</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		@endforeach
		@endif
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="single-blog-post post-list format-gallery">
						<div class="post-body py-3">
							<div class="entry-header">
								<div class="entry-content my-3">
									<div class="row my-auto">
										<div class="col-12 mb-lg-5 mb-3">
											<div class="row">
												<div class="col-12 col-lg-8 my-auto">
													<i class="fa fa-envelope d-inline fa-2x mr-4" aria-hidden="true"></i><p class="h3 d-inline">Message</p>
												</div>
												<div class="col-12 col-lg-4 my-auto text-lg-right text-left">
													<a href="#" data-toggle="modal" data-target="#add" class="btn btn-sm btn-primary"><i class="fa fa-plus mr-3"></i> Create New Message</a>
												</div>
											</div>
										</div>
										<div class="col-12 mb-lg-5 mb-2">
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="dt">
													<thead>
														<th style="width: 20%">No. Referensi</th>
														<th>Judul</th>
														<th>Status</th>
														<th style="width: 15%;">Lihat</th>
													</thead>
													<tbody>
													@if($data->count() > 0)
														@foreach($data as $row)
														<tr>
															<td>{{$row->ticket_no}}</td>
															<td>{{$row->judul}}</td>
															<td>{{$row->status}}</td>
															<td><a href="#" data-toggle="modal" data-target="#check-{{$row->id}}" class="btn btn-sm px-0 btn-block btn-primary"><i class="fa fa-eye"></i> Lihat</a></td>
														</tr>
														@endforeach
													@else
														<tr>
															<td colspan="4" style="text-align: center">Tidak Ada Data</td>
														</tr>
													@endif
													</tbody>
												</table>
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
