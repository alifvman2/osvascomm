@extends('layouts.app')

@section('content')

	<style>
		
		.main-content {
			background-color: background: rgba(248, 248, 248, 1);
		}

		.bgCard {
			background-image: url('/assets/card.png');
			background-size: cover;
			background-position: center;
			border-radius: 15px;
			height: 120px;
		}

		.bgCard.card {
			background-color: transparent !important;
			border: none;
		}

		.bg-header {
		  	background-color: rgba(65, 160, 228, 1);
		}

		.bg-header th:first-child {
		  	border-top-left-radius: 6px;
		  	border-bottom-left-radius: 6px;
		}

		.bg-header th:last-child {
		  	border-top-right-radius: 6px;
		  	border-bottom-right-radius: 6px;
		}

	</style>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('pesan'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ $message }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('alert'))
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ $message }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ $message }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ $message }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

	<div class="container">
		<div class="row">
			<h3 class="ms-2 mb-3">Dashboard</h3>
			<div class="col-3 px-0">
  				<div class="card bgCard d-flex flex-column justify-content-center p-5 pt-4 mt-1 px-0 text-white">
  					<div class="ps-5">
					    <small>Jumlah User</small>
					    <h4>{{ $totalUser }} <span class="fs-6">User</span></h4>
  					</div>
				</div>
			</div>
			<div class="col-3 px-0">
			  	<div class="card bgCard d-flex flex-column justify-content-center p-5 pt-4 mt-1 px-0 text-white">
			  		<div class="ps-5">
					    <small>Jumlah User Aktif</small>
					    <h4>{{ $aktifUser }} <span class="fs-6">User</span></h4>
			  		</div>
				</div>
			</div>
			<div class="col-3 px-0">
			  	<div class="card bgCard d-flex flex-column justify-content-center p-5 pt-4 mt-1 px-0 text-white">
			  		<div class="ps-5">
					    <small>Jumlah Produk</small>
					    <h4>{{ $totalProd }} <span class="fs-6">Produk</span></h4>
			  		</div>
				</div>
			</div>
			<div class="col-3 px-0">
			  	<div class="card bgCard d-flex flex-column justify-content-center p-5 pt-4 mt-1 px-0 text-white">
			  		<div class="ps-5">
					    <small>Jumlah Produk Aktif</small>
					    <h4>{{ $aktifProd }} <span class="fs-6">Produk</span></h4>
			  		</div>
				</div>
			</div>
			<div class="col-8 mt-3">
				<div class="card" style="border: none;">
					<div class="card-header" style="background-color: white; border: none;">
						<h5><strong>Produk Terbaru</strong></h5>
					</div>
					<div class="card-body">
						<div class="table-responsive col-12">
							<table class="col-12">
								<thead>
									<tr class="bg-header text-white">
										<th width="50%" class="ps-2">Produk</th>
										<th width="25%">Tanggal Dibuat</th>
										<th width="25%">Harga (Rp)</th>
									</tr>
								</thead>
								<tbody>
									@foreach($newProd as $np)
										<tr>
											<td class="py-1 ps-2">
												<img src="{{ asset('assets/product/'. $np->image) }}" class="img-fluid" style="max-width: 10%!important">
												{{ $np->name }}
											</td>
											<td class="py-1">{{ $np->created_at }}</td>
											<td class="py-1">Rp {{ number_format($np->price, 0, ',', '.') }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
@section('script')
@endsection