@extends('layouts.app')

@section('content')

    <style>
        
        .carousel-indicators.position-static button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 4px;
            background-color: #F9F9F9;
            border: none;
        }

        .carousel-indicators.position-static .active {
            background-color: #A19B91;
        }

        .position-relative {
            position: relative;
        }

        .card-carousel {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 1rem;
            padding: 1rem 2rem;
        }

        .card-carousel::-webkit-scrollbar {
            display: none;
        }

        .card-carousel .card {
            width: 183px;
            min-width: 15%;
            flex: 0 0 auto;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #333;
            z-index: 10;
        }

        .carousel-btn.prev {
            left: -3rem;
        }

        .carousel-btn.next {
            right: -3rem;
        }

        @media (max-width: 768px) {
            .carousel-btn.prev {
                left: -1rem;
            }
            .carousel-btn.next {
                right: -1rem;
            }
            .card-carousel .card {
                min-width: 50%;
            }
        }

        .custom-card {
            border: none!important;
            transition: all 0.2s ease-in-out;
        }

        .custom-card:hover {
            border: 1px solid rgba(214, 214, 214, 1)!important;
            box-shadow: 0px 6px 10px 0px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

    </style>

    <div class="row justify-content-center mt-4">
        <div class="col-10">
            <div id="myCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                <div class="carousel-inner mb-1">
                    @foreach($banner as $key => $bn)
                        <div class="carousel-item @if($key == 0) active @endif">
                            <a href="#" class="text-decoration-none">
                                <img src="{{ asset('assets/banner/' . $bn->banner) }}" class="d-block w-100" alt="{{ $bn->name }}">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex align-items-center" style="margin-left: 0px!important;">
                    <button type="button" class="btn btn-transparent px-0 pe-1" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <i class="fa-solid fa-chevron-left fa-xl" style="color: #A19B91;"></i>
                    </button>

                    <div class="carousel-indicators position-static m-0 p-0">
                        @foreach($banner as $key => $bn2)
                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $key }}" @if($key == 0) class="active" aria-current="true" @endif>
                            </button>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-transparent px-0 ps-1" data-bs-target="#myCarousel" data-bs-slide="next">
                        <i class="fa-solid fa-chevron-right fa-xl" style="color: #A19B91;"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex align-items-center my-5 mb-4" style="margin-left: 0px!important;">
                <h1><strong>Terbaru</strong></h1>
            </div>
            
            <div class="position-relative">

                <button class="carousel-btn prev" onclick="scrollCarousel(-1)">
                    <i class="fa-solid fa-chevron-left fa-2xl"></i>
                </button>

                <div class="card-carousel card-deck flex-grow-1 px-0" id="cardCarousel">
                    @foreach ($newProd as $np)
                        <a href="#" class="text-decoration-none" target="_blank">
                            <div class="card custom-card border p-3 text-left">
                                <img class="card-img-top" src="{{ asset('assets/product/' . $np->image) }}" alt="{{ $np->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <strong>
                                            {{ $np->name }}
                                        </strong>
                                    </h5>
                                    <p class="card-text text-info">
                                        <strong>
                                            IDR {{ number_format($np->price, 0, ',', '.') }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <button class="carousel-btn next" onclick="scrollCarousel(1)">
                    <i class="fa-solid fa-chevron-right fa-2xl"></i>
                </button>

            </div>

            <div class="d-flex align-items-center my-5 mb-4" style="margin-left: 0px!important;">
                <h1><strong>Produk Tersedia</strong></h1>
            </div>
            
            <div class="row row-cols-2 row-cols-md-5 g-3">

                @foreach ($product as $prod)
                    <a href="#" class="text-decoration-none" target="_blank">
                        <div class="col custom-card card p-3 text-left">
                            <img class="card-img-top" src="{{ asset('assets/product/' . $prod->image) }}" alt="{{ $prod->name }}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <strong>
                                        {{ $prod->name }}
                                    </strong>
                                </h5>
                                <p class="card-text text-info">
                                    <strong>
                                        IDR {{ number_format($prod->price, 0, ',', '.') }}
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>

            <div class="row d-flex align-items-center mb-5">
                <div align="center">
                    <button type="button" class="btn btn-outline-primary rounded-0">Lihat lebih banyak</button>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('script')

    <script>
        function scrollCarousel(direction) {
            const container = document.getElementById('cardCarousel');
            const card = container.querySelector('.card');
            const cardWidth = card.offsetWidth + 16; // 16 = gap approx.
            container.scrollBy({ left: direction * cardWidth, behavior: 'smooth' });
        }
    </script>

@endsection