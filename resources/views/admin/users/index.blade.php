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
			<h3 class="ms-2">Manajemen Users</h3>	
			<a class="btn btn-primary rounded-0" href="#" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambah User</a>
		</div>
		<div class="table-responsive">
			<table id="tableUser">
				<thead>
					<tr class="bg-white">
						<th class="p-3 ps-4">No</th>
						<th class="p-3">Nama Lengkap</th>
						<th class="p-3">Email</th>
						<th class="p-3">No. Telepon</th>
						<th class="p-3">Status</th>
						<th class="p-3"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $dt)
						<tr>
							<td class="px-3 py-1">{{ $loop->iteration }}</td>
							<td class="px-3 py-1">{{ $dt->name }}</td>
							<td class="px-3 py-1">{{ $dt->email }}</td>
							<td class="px-3 py-1">{{ $dt->no_telp }}</td>
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
                                data-user-id="{{ $dt->id }}" class="btn btn-success rounded-pill">
									<i class="fa-solid fa-eye"></i>
								</a>
								<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" 
                                data-user-id="{{ $dt->id }}" class="btn btn-warning rounded-pill">
									<i class="fa-solid fa-pen-to-square"></i>
								</a>
								<a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                data-user-id="{{ $dt->id }}" data-user-name="{{ $dt->name }}" class="btn btn-danger rounded-pill">
									<i class="fa-solid fa-trash"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

    <div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUser" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content rounded-0">
                <div class="modal-header border-0">
       	 			<div class="d-flex justify-content-between align-items-center mb-3 w-100 h-100">
       	 				<p></p>
                		<h5>Tambah User</h5>
                		<button type="button" class="btn btn-transparent" data-bs-dismiss="modal">
                			<i class="fa-solid fa-x"></i>
                		</button>
                	</div>
                </div>
                <div class="modal-content border-0 p-2">
                	<div class="container">
                		<form method="POST" action="{{ route('Admin.Users.store') }}" enctype="multipart/form-data">
                			@csrf
	                		<div class="form-group mb-3">
	                			<label class="form-label">Nama</label>
	                			<input type="text" placeholder="Masukkan Nama" class="form-control rounded-0" name="name" value="{{ old('name') }}" required>
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Nomor Telepon</label>
	                			<input type="number" placeholder="Masukkan Nomor Telepon (628/08)" class="form-control rounded-0" name="no_telp" value="{{ old('no_telp') }}">
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Email</label>
	                			<input type="email" placeholder="Masukkan Nomor Email" class="form-control rounded-0" name="email" value="{{ old('email') }}" required>
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
        <div class="modal-dialog modal-l modal-dialog-scrollable">
            <div class="modal-content rounded-0">
                <div class="modal-header border-0">
       	 			<div class="d-flex justify-content-between align-items-center mb-3 w-100 h-100">
       	 				<p></p>
                		<h5>Detail User</h5>
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
                			<label class="form-label">Nomor Telepon</label>
                			<input type="number" placeholder="Masukkan Nomor Telepon (628/08)" class="form-control rounded-0" name="no_telp" id="showNo_telp" readonly>
                		</div>
                		<div class="form-group mb-3">
                			<label class="form-label">Email</label>
                			<input type="email" placeholder="Masukkan Nomor Email" class="form-control rounded-0" name="email" id="showEmail" readonly>
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
                		<h5>Edit User</h5>
                		<button type="button" class="btn btn-transparent" data-bs-dismiss="modal">
                			<i class="fa-solid fa-x"></i>
                		</button>
                	</div>
                </div>
                <div class="modal-content border-0 p-2">
                	<div class="container">
                		<form id="editForm" action="{{ route('Admin.Users.update', encrypt('0')) }}" method="POST" enctype="multipart/form-data">
                			@csrf
                			@method('PUT')
	                		<div class="form-group mb-3">
	                			<label class="form-label">Nama</label>
	                			<input type="text" placeholder="Masukkan Nama" class="form-control rounded-0" name="name" id="editName" required>
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Nomor Telepon</label>
	                			<input type="number" placeholder="Masukkan Nomor Telepon (628/08)" class="form-control rounded-0" name="no_telp" id="editNo_telp">
	                		</div>
	                		<div class="form-group mb-3">
	                			<label class="form-label">Email</label>
	                			<input type="email" placeholder="Masukkan Nomor Email" class="form-control rounded-0" name="email" id="editEmail" required>
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
            	<form id="deleteForm" action="{{ route('Admin.Users.destroy', 0) }}" method="POST" class="d-inline">
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
		
		$('#tableUser').DataTable({
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

		function changeStatus(id, val) {

  			if (confirm("Apakah Anda yakin akan merubah status user ini?")) {
  				$.ajax({
			        url: "{{ route('Admin.Users.status') }}", // sesuaikan dengan route kamu
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
                const id = button.getAttribute('data-user-id');
                const url = `/Admin/Users/${id}`;

                try {
                    const response = await fetch(url);
                    if (response.ok) {
                        const resp = await response.json();
                        const id = resp.id;
                        const data = resp.data;

                        document.getElementById('showName').value = data.name;
                        document.getElementById('showNo_telp').value = data.no_telp;
                        document.getElementById('showEmail').value = data.email;

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
                const id = button.getAttribute('data-user-id');
                const url = `/Admin/Users/${id}`;

                try {
                    const response = await fetch(url);
                    if (response.ok) {
                        const resp = await response.json();
                        const id = resp.id;
                        const data = resp.data;

                        document.getElementById('editName').value = data.name;
                        document.getElementById('editNo_telp').value = data.no_telp;
                        document.getElementById('editEmail').value = data.email;
                        document.getElementById('editForm').action = `/Admin/Users/${id}`;

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
                const id = button.getAttribute('data-user-id');
                const name = button.getAttribute('data-user-name');

                document.getElementById('deleteText').innerHTML = `Apakah kamu yakin menghapus ${name}?`;
            	document.getElementById('deleteForm').action = `/Admin/Users/${id}`;
            });
        });

	</script>

@endsection