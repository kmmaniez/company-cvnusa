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
                                    <li class="breadcrumb-item active" aria-current="page">{{ request()->route()->uri() }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <section id="main-container" class="main-container">
        <div class="container">

            @if (request()->has('kategori'))
            @endif
            <div class="row">
                <div class="col-12">

                    <div class="row shuffle-wrapper">
                        <div class="col-1 shuffle-sizer"></div>
                        @foreach ($data as $project)
                            <div class="col-lg-4 col-md-6 shuffle-item">
                                <div class="project-img-container">
                                    <a class="gallery-popup" href="{{ Storage::url($project->thumbnail) }}">
                                        <img class="img-fluid object-fit-cover" style="width: 300px; height: 300px;" src="{{ Storage::url($project->thumbnail) }}"
                                            alt="project-image">
                                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                    </a>
                                    <div class="project-item-info">
                                        <div class="project-item-info-content">
                                            <h3 class="project-item-title">
                                                <a href="{{ route('public.project-single', $project->slug) }}">{{ $project->nama_project }}</a>
                                            </h3>
                                            <p class="project-cat">Commercial, Interiors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div><!-- shuffle end -->
                </div>

            </div><!-- Content row end -->

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
@push('javascript')
    <script>
        // window.onscroll = function(e){
        //     console.log(e);
        // }
        const btn = document.getElementById('btnAllProject')
        $('#shuffle-filter').each(idx => {
            console.log(idx);
        })
        $('#btnAllProject').on('click', function(e) {
            e.preventDefault()
            btn.offsetTop = 100;
            console.log(e);
        })
    </script>
@endpush
