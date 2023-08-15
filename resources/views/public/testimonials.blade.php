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

    <x-public.testimonial :dataclient="$data"></x-public.testimonial>
@endsection
