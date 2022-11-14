@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide m" data-bs-ride="carousel" style="padding-top: 88px;">
        <div class="content text-center">
            <h2>WELCOME TO PM LIBRARY</h2>
            <div class="d-flex justify-content-center">
                <a href="#about-us-id" class="cmn-btn">About Us</a>
            </div>
        </div>
        <div class="carousel-indicators">
            @php
            $i = 0;
            @endphp
            @while ($i < count($carouselImg))
                @if ($i == 0)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                @else
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}" aria-label="Slide {{$i + 1}}"></button>
                @endif
                @php
                    $i++;
                @endphp
            @endwhile
        </div>
        <div class="carousel-inner">
            @php
                $j = 0;
            @endphp
            @while ($j < count($carouselImg))
                @if ($j == 0)
                <div class="carousel-item active">
                @else
                <div class="carousel-item">
                @endif
                    <img src="{{ asset('images/' . $carouselImg[$j]) }}" class="d-block w-100" alt="...">
                </div>
                @php
                    $j++;
                @endphp
            @endwhile
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container my-5" id="about-us-id">
        <div class="row">
            <div class="col-md-5 my-4">
                <img src="{{URL::asset('/images/lib.jpg')}}" class="img-fluid shadow" alt="">
            </div>
            <div class="col-md-7 my-4">
                <h1>About <span class="text-custom">Us</span></h1>
                <p>
                    We are one of the biggest library in Indonesia, established by PT Musang. Ever since our establishment in 1999, we have been one of the most loved and visited library in Indonesia, with our excellent ambience and various collection of books. Having reached success in our physical location of the library, we are now branching out to the digital library form through this website to further reach the books aficionado so that they can borrow books from us more conveniently.
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="my-4">Our <span class="text-custom">Services</span></h1>
        <div class="row">
            @foreach ($services as $service)
            <div class="services col-md-4 my-4">
                <div class="card text-justify">
                    <div class="card-body">
                        <h5 class="card-title">{{$service['serviceName']}}</h5>
                        <p class="card-text">{{$service['description']}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="awards-section pt-50 pb-100" id="awards">
        <div class="container">
            <h1 class="my-4">Our <span class="text-custom">Awards</span></h1>
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-lg-7 mb-30">
                    <div class="awards-item-area">
                        <div class="row justify-content-center mb-30-none">
                            @for ($i = 0; $i < count($awardsDetail); $i++) 
                                @if ($i % 2) 
                                <div class="col-lg-6 mb-30">
                                    <div class="awards-item awards-item--style text-center mt-30">
                                @else
                                <div class="col-lg-6">
                                    <div class="awards-item text-center">
                                        @endif
                                        <div class="awards-icon">
                                            <img src="{{ asset('images/' . $awardsDetail[$i]['img']) }}">
                                        </div>
                                        <h3 class="title">{{$awardsDetail[$i]['name']}}</h3>
                                        <p>{{$awardsDetail[$i]['desc']}}</p>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-30">
                        <div class="awards-content">
                            <h2 class="title">Best of The Best</h2>
                            <p>Take a look at all the awards PM Library has received. These awards are a testament to our commitment to build a library with high quality customer service, book collections, ambience, and architectural design so that every customer would be interested in visiting us and reading more books to improve their literacy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection