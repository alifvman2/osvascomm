<style>
    
    .custom-placeholder::placeholder {
        /*font-size: 12px;*/
        color: #A19B91;
    }

    .input-with-icon .form-control {
        border-right: none;
        box-shadow: none;
    }

    .input-with-icon .input-group-text {
        background-color: #F9F9F9;
        border-left: none;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .input-with-icon .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .input-with-icon .form-control:focus {
        box-shadow: none;
    }

</style>
<nav class="navbar navbar-expand-lg navbar-ligth bg-ligth border-bottom border-3" style="background-color: rgba(255, 255, 255, 1);">
  <div class="container">
    <div class="d-flex flex-row justify-content-center">
        <a class="navbar-brand" style="margin-left: 10px" href="{{ url('/') }}">
            <img class="img-fluid pt-1" src="/assets/logo.png" alt="Logo">
            <strong>
                {{ config('app.name', 'Laravel') }}
            </strong>
        </a>
    </div>
    @if (request()->routeIs('home'))
        <div class="container" align="center">
            <div class="col-8">
                <div class="input-group input-with-icon">
                    <input type="text" class="form-control custom-placeholder" style="background-color: #F9F9F9;" placeholder="Cari parfum kesukaanmu">
                    <span class="input-group-text">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
            </div>
        </div>
    @endif
        @if(Auth::check() && Auth::user()->role == 'admin')
            <div class="d-flex align-items-center dropdown">
                <button class="btn col-12 row" type="button" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="row">
                        <div class="col-8">
                            <p class="textSize mb-0">Hallo {{ Auth::user()->role }},</p>
                            <p class="fs-4 mb-0">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="col-4">
                            @if(Auth::user()->foto)
                                <img src="/assets/profile.png" alt="Profile" class="img-fluid rounded-circle">
                            @else
                                <img src="/assets/profile.png" alt="Profile" class="img-fluid rounded-circle">
                            @endif
                        </div>
                    </div>
                </button>
                <div class="dropdown-menu mt-3 container" id="dropdownProfile" style="background-color: background: rgba(255, 255, 255, 1);">
                    <div align="center">
                        <img src="/assets/profile.png" alt="Profile" class="img-fluid rounded-circle mb-3">
                        <p class="mb-0"><strong>{{ Auth::user()->name }}</strong></p>
                        <p class="textSize mb-5">{{ Auth::user()->email }}</p>
                        <div class="px-1">
                            <hr>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-tranparent" style="color: red;" type="submit">
                                <i class="fa-solid fa-power-off fa-xl me-1"></i><span>Keluar</span>
                            </button>
                        </form>
                    </div>
                    <!-- <li>
                        <a class="dropdown-item d-flex align-items-center text-white" href="#"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                    </li>
                    <li>
                    </li> -->
                </div>
            </div>
        @else
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item container">
                            <a class="btn btn-outline-primary rounded-0" href="{{ route('loginCust') }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary rounded-0" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        @endif
    </div>
</nav>
