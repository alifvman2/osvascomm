<style>
	.abotUs {
		font-family: SF Pro Display;
		display: inline-block;
  		vertical-align: baseline;
		letter-spacing: 0px;
		text-align: center;
	}

</style>
<footer class="text-center text-lg-start pt-5 border-top">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0 mx-2 text-center px-4">
			    <div class="d-flex flex-row justify-content-center mb-4">
			        <a class="navbar-brand" style="margin-left: 10px" href="{{ url('/') }}">
			        	<img class="img-fluid pt-1" src="/assets/logo.png" alt="Logo">
			        	<strong class="text-uppercase">
			        		{{ config('app.name', 'Laravel') }}
			        	</strong>
			        </a>
			    </div>
                <p class="abotUs my-2">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo in vestibulum, sed dapibus tristique nullam.
                </p>

	            <div class="flex-row justify-content-center d-flex align-items-center mt-5">
	                <!-- <div align="center"> -->
	                    <a href="#" class="btn btn-transparent">
	                    	<i class="fa-brands fa-facebook-f" style="color: blue;"></i>
	                    </a>
	                    <a href="#" class="btn btn-transparent">
	                    	<i class="fa-brands fa-twitter" style="color: blue;"></i>
	                    </a>
	                    <a href="#" class="btn btn-transparent">
	                    	<i class="fa-brands fa-instagram" style="color: blue;"></i>
	                    </a>
	                <!-- </div> -->
	            </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4 mb-md-0 mx-2 text-start">
                <h5 class="mb-4">Layanan</h5>
                <ul class="list-unstyled mb-0">
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">Bantuan</a></li>
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">Tanya Jawab</a></li>
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">Hubungi Kami</a></li>
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">Cara Berjualan</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 mb-4 mb-md-0 mx-2 text-start">
                <h5 class="mb-4">Tentang Kami</h5>
                <ul class="list-unstyled mb-0">
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">About Us</a></li>
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">Karir</a></li>
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">Blog</a></li>
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">Kebijakan Privasi</a></li>
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">Syarat dan Ketentuan</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 mb-4 mb-md-0 mx-2 text-start">
                <h5 class="mb-4">Mitra</h5>
                <ul class="list-unstyled mb-0">
                    <li class="my-2"><a href="#" class="text-dark text-decoration-none text-uppercase">Supplier</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="text-center p-2 text-white" style="background-color: rgba(228, 253, 255, 1);">
        <!-- © {{ date('Y') }} Nama Perusahaan. All rights reserved. -->
    </div>
</footer>