@extends('layouts.public.master')

@section('content')
    <div id="banner-area" class="banner-area" style="background-image:url(
        @if (count($wallpaper) > 0 && $wallpaper[0]->wallpaper_image != null)
            {{ Storage::url($wallpaper[0]->wallpaper_image) }}
        @else
            {{ url('assets/images/banner/banner1.jpg')  }}
        @endif
    )">
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

    <x-public.clients :dataclient="$data"></x-public.clients>
@endsection
