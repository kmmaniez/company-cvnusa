@extends('layouts.public.master')

@section('content')
    <div id="banner-area" class="banner-area" style="background-image:url({{ ($wallpaper[0]->wallpaper_image == NULL) ? url('assets/images/banner/banner1.jpg') : Storage::url($wallpaper[0]->wallpaper_image) }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">{{ request()->route()->uri() }}</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('public.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ request()->route()->uri() }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <section id="main-container" class="main-container pb-2">
        <div class="container">
            <div class="row">
                @foreach ($services as $service)
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="" style="width: 100%; height: 250px; object-fit: cover;" src="{{ $service->gambar ? Storage::url($service->gambar) : url("assets/images/services/service1.jpg") }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">{{ $service->title }}</a></h3>
                                <p>{{ $service->description }}</p>
                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                @endforeach

            </div><!-- Main row end -->
        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
