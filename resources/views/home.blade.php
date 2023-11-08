@extends('layout.layout')

@section('content')

<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Data Barang</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Tables</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Barang</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Master Barang</h4>
										<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-plus"></i>
											Tambah Data
										</button>
									</div>
								</div>
								<div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-danger">
                                {{ session('success') }}
                            </div>
                        @endif                  
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Barang</th>
													<th>Kategori</th>
													<th>Harga</th>
													<th>Stok</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@php $no = 1; @endphp
													@if($barang != '')
														@foreach($barang as $b)
															<tr>
																<td>{{ $no++ }}</td>
																<td>{{ $b->nama_barang }}</td>
																<td>{{ $b->nama_kategori }}</td>
																<td>Rp {{ number_format($b->harga, 2, ',', '.') }}</td>
																<td>{{ ($b->stok_ins_sum_total != '' ? $b->stok_ins_sum_total : 0) - ($b->stok_out_sum_total_keluar != '' ? $b->stok_out_sum_total_keluar : 0) }}</td>
																<td>
																<a href="#modaledit{{ $b->id }}" data-toggle="modal" class="btn btn-xs btn-success">
																	<i class="fa fa-edit"></i> Edit
																</a>
																<a href="#modalHapus{{ $b->id }}" data-toggle="modal" class="btn btn-xs btn-danger">
																	<i class="fa fa-trash"></i> Hapus
																</a>
																</td>
															</tr>
														@endforeach
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
        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header no-bd">
                <h5 class="modal-title">
                  <span class="fw-mediumbold"> New</span>
                  <span class="fw-light"> Row </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="{{ url('barang-simpan') }}" enctype="multipart/form-data">
			  	@csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="name" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="kategori">
						@foreach($kategori as $k)
							<option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
						@endforeach
					</select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>Save Changes </button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-undo"></i>Close </button>
                </div>
              </form>
            </div>
          </div>
        </div>
@foreach ($barang as $b)
<div class="modal fade" id="modalHapus{{ $b->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="barang/destroy/{{ $b->id }}">
                @csrf
                <div class="modal-body">
                    <p class="text-center">Apakah Anda ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-undo"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach		
@foreach ($barang as $b)
<div class="modal fade" id="modaledit{{$b->id}}" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header no-bd">
                <h5 class="modal-title">
                  <span class="fw-mediumbold"> New</span>
                  <span class="fw-light"> Row </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="barang/update/{{ $b->id }}" enctype="multipart/form-data">
			  	@csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="name" placeholder="" value="{{ $b->nama_barang }}" required>
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga" value="{{ $b->harga }}" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="kategori">
						@foreach($kategori as $k)
							<option {{ $b->id_kategori == $k->id ? 'selected' : ''; }} value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
						@endforeach
					</select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>Save Changes </button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-undo"></i>Close </button>
                </div>
              </form>
            </div>
          </div>
        </div>
@endforeach		
@endsection