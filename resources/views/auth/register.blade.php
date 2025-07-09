@extends('layouts.app')

@section('content')
    
    <style>
        body {
            overflow: hidden!important;
        }

        .bg-login {
            background-image: url('/assets/bg_login.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; /* atau sesuai tinggi yang diinginkan */
        }

        .full-height {
            min-height: 100vh;
            overflow: hidden;
        }
        
    </style>

    <div class="row full-height m-0">
        <div class="col-6 bg-login d-flex justify-content-center align-items-center p-0">
            <div class="col-8">
                <div class="card" style="border: none; background: transparent;">
                    <div class="card-header" style="border: none; background: transparent;" align="center">
                        <h1 class="text-uppercase" style="background: transparent;"><strong>{{ config('app.name', 'Laravel') }}</strong></h1>
                    </div>
                    <div class="card-body" align="center">
                        <p class="fw-lighter mb-5 textSize">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 d-flex justify-content-center align-items-center p-0">
            <div class="col-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card" style="border: none;">
                    <div class="card-header" style="border: none; background: transparent;">
                        <strong>
                            Selamat Datang
                        </strong>
                    </div>
                    <div class="card-body pt-0">
                        <p class="fw-lighter mb-5 textSize textColor">Silahkan masukkan nama nomor telepon dan Email Anda untuk mulai menggunakan aplikasi</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3 form-group">
                                <label for="name" class="form-label">Nama</label>
                                <input id="name" type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-group">
                                <label for="no_telp" class="form-label">Nomor Telepon</label>
                                <input id="no_telp" type="text" class="form-control rounded-0 @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required autocomplete="no_telp" autofocus>

                                @error('no_telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-group">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="text" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-0">
                                DAFTAR
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
