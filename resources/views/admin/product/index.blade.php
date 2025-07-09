@extends('layouts.app')

@section('content')

	<style>
		
		.main-content {
			background-color: background: rgba(248, 248, 248, 1);
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
        <div class="d-flex justify-content-between align-items-center mb-3">
			<h3 class="ms-2">Manajemen Produk</h3>	
			<a class="btn btn-primary rounded-0" href="#" data-bs-toggle="modal" data-bs-target="#tambahProduct">Tambah Produk</a>
		</div>
		<div class="table-responsive">
			<table id="tableProd">
				<thead>
					<tr class="bg-white">
						<th class="p-3 ps-4">No</th>
						<th class="p-3">Nama Produk</th>
						<th class="p-3">Image</th>
						<th class="p-3">Banner</th>
						<th class="p-3">Qty</th>
						<th class="p-3">Unit</th>
						<th class="p-3">Price</th>
						<th class="p-3">Status</th>
						<th class="p-3" width="20%"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $dt)
						<tr>
							<td class="px-3 py-1">{{ $loop->iteration }}</td>
							<td class="px-3 py-1">{{ $dt->name }}</td>
							<td class="px-3 py-1">
								@if($dt->image)
									<a href="{{ asset('assets/product/'.$dt->image) }}" class="text-decoration-none" target="_blank">
										<img src="{{ asset('assets/product/'.$dt->image) }}" class="img-fluid" style="max-width: 50%!important">
									</a>
								@else
									No Image
								@endif
							</td>
							<td class="px-3 py-1">
								@if($dt->banner)
									<a href="{{ asset('assets/banner/'.$dt->banner) }}" class="text-decoration-none" target="_blank">
										<img src="{{ asset('assets/banner/'.$dt->banner) }}" class="img-fluid" style="max-width: 100%!important">
									</a>
								@else
									No Banner
								@endif
							</td>
							<td class="px-3 py-1">{{ $dt->qty }}</td>
							<td class="px-3 py-1">{{ $dt->unit }}</td>
							<td class="px-3 py-1">Rp {{ number_format($dt->price, 0, ',', '.') }}</td>
							<td class="px-3 py-1">
								@if($dt->active)
									<button type="button" class="btn btn-success rounded-pill" onclick="changeStatus('{{ $dt->id }}', 'non-aktif')">
										Aktif
									</button>
								@else
									<button type="button" class="btn btn-danger rounded-pill" onclick="changeStatus('{{ $dt->id }}', 'aktif')">
										Tidak Aktif
									</button>
								@endif
							</td>
							<td class="px-3 py-1">
								<a href="#" data-bs-toggle="modal" data-bs-target="#showModal" 
                                data-product-id="{{ $dt->id }}" class="btn btn-success rounded-pill">
									<i class="fa-solid fa-eye"></i>
								</a>
								<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" 
                                data-product-id="{{ $dt->id }}" class="btn btn-warning rounded-pill">
									<i class="fa-solid fa-pen-to-square"></i>
								</a>
								<a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                data-product-id="{{ $dt->id }}" data-product-name="{{ $dt->name }}" class="btn btn-danger rounded-pill">
									<i class="fa-solid fa-trash"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

    <div class="modal fade" id="tambahProduct" tabindex="-1" aria-labelledby="tambahProduct" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content rounded-0">
                <div class="modal-header border-0">
       	 			<div class="d-flex justify-content-between align-items-center mb-3 w-100 h-100">
       	 				<p></p>
                		<h5>Tambah Product</h5>
                		<button type="button" class="btn btn-transparent" data-bs-dismiss="modal">
                			<i class="fa-solid fa-x"></i>
                		</button>
                	</div>
                </div>
                <div class="modal-content border-0 p-2">
                	<div class="container">
                		<form method="POST" action="{{ route('Admin.Product.store') }}" enctype="multipart/form-data">
                			@csrf
	                		<div class="form-group mb-3">
	                			<label class="form-label">Nama</label>
	                			<input type="text" placeholder="Masukkan Nama" class="form-control rounded-0" name="name" value="{{ old('name') }}" required>
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Image</label>
	                			<input type="file" class="form-control rounded-0" name="file" value="{{ old('file') }}">
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Banner</label>
	                			<input type="file" class="form-control rounded-0" name="banner" value="{{ old('banner') }}">
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Qty</label>
	                			<input type="number" placeholder="Masukkan Jumlah" class="form-control rounded-0" name="qty" value="{{ old('qty') }}" required>
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Unit</label>
	                			<input type="text" placeholder="Masukkan Unit/Jenis Barang" class="form-control rounded-0" name="unit" value="{{ old('unit') }}" required>
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Harga</label>
	                			<input type="text" placeholder="Masukkan Harga Barang" class="form-control rounded-0" name="price" value="{{ old('price') }}" onchange="convertToRupiah(this)" required>
	                		</div>
	                		<button type="submit" class="btn btn-primary rounded-0 w-100 mb-3">
	                			SIMPAN
	                		</button>
	                	</form>
                	</div>
                </div>
            </div>
		</div>
	</div>

    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content rounded-0">
                <div class="modal-header border-0">
       	 			<div class="d-flex justify-content-between align-items-center mb-3 w-100 h-100">
       	 				<p></p>
                		<h5>Detail Produk</h5>
                		<button type="button" class="btn btn-transparent" data-bs-dismiss="modal">
                			<i class="fa-solid fa-x"></i>
                		</button>
                	</div>
                </div>
                <div class="modal-content border-0 p-2">
                	<div class="container">
                		<div class="form-group mb-3">
                			<label class="form-label">Nama</label>
                			<input type="text" placeholder="Masukkan Nama" class="form-control rounded-0" name="name" id="showName" readonly>
                		</div>
                		<div class="form-group mb-3">
                			<label class="form-label">Image</label><br>
                			<a id="showImage" href="#" class="text-decoration-none" disabled>No Image</a>
                		</div>
                		<div class="form-group mb-3">
                			<label class="form-label">Banner</label><br>
                			<a id="showBanner" href="#" class="text-decoration-none" disabled>No Image</a>
                		</div>
                		<div class="form-group mb-3">
                			<label class="form-label">Qty</label>
                			<input type="number" placeholder="Masukkan Jumlah" class="form-control rounded-0" name="qty" id="showQty" readonly>
                		</div>
                		<div class="form-group mb-3">
                			<label class="form-label">Unit</label>
                			<input type="text" placeholder="Masukkan Unit/Jenis Barang" class="form-control rounded-0" name="unit" id="showUnit" readonly>
                		</div>
                		<div class="form-group mb-3">
                			<label class="form-label">Harga</label>
                			<input type="text" placeholder="Masukkan Harga Barang" class="form-control rounded-0" name="price" id="showPrice" readonly>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content rounded-0">
                <div class="modal-header border-0">
       	 			<div class="d-flex justify-content-between align-items-center mb-3 w-100 h-100">
       	 				<p></p>
                		<h5>Edit Produk</h5>
                		<button type="button" class="btn btn-transparent" data-bs-dismiss="modal">
                			<i class="fa-solid fa-x"></i>
                		</button>
                	</div>
                </div>
                <div class="modal-content border-0 p-2">
                	<div class="container">
                		<form id="editForm" action="{{ route('Admin.Product.update', 0) }}" method="POST" enctype="multipart/form-data">
                			@csrf
                			@method('PUT')
	                		<div class="form-group mb-3">
	                			<label class="form-label">Nama</label>
	                			<input type="text" placeholder="Masukkan Nama" class="form-control rounded-0" name="name" id="editName" required>
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Image</label>
	                			<a id="editImage" href="#" class="text-decoration-none" style="display: none;" target="_blank">No Image</a>
	                			<input type="file" class="form-control rounded-0" name="file" value="{{ old('file') }}">
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Banner</label>
	                			<a id="editBanner" href="#" class="text-decoration-none" style="display: none;" target="_blank">No Image</a>
	                			<input type="file" class="form-control rounded-0" name="banner" value="{{ old('banner') }}">
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Qty</label>
	                			<input type="number" placeholder="Masukkan Jumlah" class="form-control rounded-0" name="qty" id="editQty" required>
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Unit</label>
	                			<input type="text" placeholder="Masukkan Unit/Jenis Barang" class="form-control rounded-0" name="unit" id="editUnit" required>
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Harga</label>
	                			<input type="text" placeholder="Masukkan Harga Barang" class="form-control rounded-0" name="price" id="editPrice" required>
	                		</div>
	                		<button type="submit" class="btn btn-primary rounded-0 w-100 mb-3">
	                			SIMPAN
	                		</button>
	                	</form>
                	</div>
                </div>
            </div>
		</div>
	</div>


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content rounded-0">
                <div class="modal-header border-0">
       	 			<div class="d-flex justify-content-between align-items-center mb-3 w-100 h-100">
       	 				<p></p>
                		<h5>Konfirmasi Hapus</h5>
                		<button type="button" class="btn btn-transparent" data-bs-dismiss="modal">
                			<i class="fa-solid fa-x"></i>
                		</button>
                	</div>
                </div>
            	<form id="deleteForm" action="{{ route('Admin.Product.destroy', 0) }}" method="POST" class="d-inline">
               	 	@csrf
    				@method('DELETE')
	                <div class="modal-content border-0 p-2">
	                	<div class="container">
	                		<h5 class="textSize" id="deleteText"></h5>	
	                	</div>
	                </div>
	                <div class="modal-footer border-0">
	                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
	                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Hapus</button>
	                </div>
            	</form>
            </div>
        </div>
    </div>


@endsection
@section('script')

	<script>
		
		$('#tableProd').DataTable({
			lengthChange: false,
			searching: false,
			drawCallback: function(settings) {
			    var api = this.api();
				var dataCount = api.data().length;

			    var container = $(api.table().container());

			    if (dataCount <= api.page.len()) {
			      	container.find('.dataTables_paginate').hide();
			      	container.find('.dataTables_info').hide();
			    } else {
			      	container.find('.dataTables_paginate').show();
			      	container.find('.dataTables_info').show();
			    }
			}
		});

        function convertToRupiah(input) {
            // Menghapus karakter selain angka
            var pureNumber = input.value.replace(/\D/g, '');
            
            // Format ke format Rupiah
            var formattedRupiah = '';
            var numberString = pureNumber.toString();
            var rupiah = '';

            if (numberString.length <= 3) {
                rupiah = numberString;
            } else {
                rupiah = numberString.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            var cur = 'Rp ';

            input.value = cur + rupiah;
        }

		function changeStatus(id, val) {

  			if (confirm("Apakah Anda yakin akan merubah status Produk ini?")) {
  				$.ajax({
			        url: "{{ route('Admin.Product.status') }}", // sesuaikan dengan route kamu
			        method: 'POST',
			        data: {
			            _token: '{{ csrf_token() }}', // untuk Laravel
			            id: id,
			            val: val
			        },
				    success: function(response) {
				        if (response.success) {
				            alert(response.message); // "Status user berhasil diperbarui."
				            location.reload();
				        } else {
				            alert("Terjadi kesalahan saat memperbarui status.");
				        }
				    },
				    error: function(xhr) {
				        alert("Gagal melakukan request.");
				        console.log(xhr.responseText);
				    }
			    });
  			}else{

  				alert("Perubahan status di batalkan!");

  			}

		}

        document.addEventListener('DOMContentLoaded', () => {
            const showModal = document.getElementById('showModal');
            showModal.addEventListener('show.bs.modal', async (event) => {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-product-id');
                const url = `/Admin/Product/${id}`;

                try {
                    const response = await fetch(url);
                    if (response.ok) {
                        const resp = await response.json();
                        const id = resp.id;
                        const data = resp.data;

                        document.getElementById('showName').value = data.name;
                        document.getElementById('showQty').value = data.qty;
                        document.getElementById('showUnit').value = data.unit;
                        document.getElementById('showPrice').value = data.Rprice;
                        const image = document.getElementById('showImage');
						image.href = data.imageUrl || '#';
						image.textContent = data.imageUrl ? 'Show Image' : 'No File Available';
						image.disabled = false;

                        const banner = document.getElementById('showBanner');
						banner.href = data.bannerUrl || '#';
						banner.textContent = data.bannerUrl ? 'Show Banner' : 'No File Available';
						banner.disabled = false;

                    } else {
                        console.error('Failed to fetch data for modal');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', async (event) => {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-product-id');
                const url = `/Admin/Product/${id}`;

                try {
                    const response = await fetch(url);
                    if (response.ok) {
                        const resp = await response.json();
                        const id = resp.id;
                        const data = resp.data;

                        document.getElementById('editName').value = data.name;
                        document.getElementById('editQty').value = data.qty;
                        document.getElementById('editUnit').value = data.unit;
                        document.getElementById('editPrice').value = data.Rprice;
                        document.getElementById('editForm').action = `/Admin/Product/${id}`;
                        const image = document.getElementById('editImage');
						image.href = data.imageUrl || '#';
						image.textContent = data.imageUrl ? 'Show Image' : 'No File Available';
						image.style.display = 'block';

                        const banner = document.getElementById('editBanner');
						banner.href = data.bannerUrl || '#';
						banner.textContent = data.bannerUrl ? 'Show Banner' : 'No File Available';
						banner.style.display = 'block';

                    } else {
                        console.error('Failed to fetch data for modal');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', async (event) => {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-product-id');
                const name = button.getAttribute('data-product-name');

                document.getElementById('deleteText').innerHTML = `Apakah kamu yakin menghapus ${name}?`;
            	document.getElementById('deleteForm').action = `/Admin/Product/${id}`;
            });
        });

	</script>

@endsection