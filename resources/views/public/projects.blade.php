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
            {{-- @dump($req) --}}
            @if (request()->has('kategori'))
                punya
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="shuffle-btn-group">
                        {{-- @foreach ($kategoris as $kategori)
                        <label for="commercial">
                            <input type="radio" name="shuffle-filter" id="commercial" value="commercial">{{ $kategori->nama_kategori }}
                        </label>
                        @endforeach --}}
                        <label class="active" for="all">
                            <input type="radio" name="shuffle-filter" id="all" value="all" checked="checked">Show
                            All
                        </label>
                        <label for="commercial">
                            <input type="radio" name="shuffle-filter" id="commercial" value="commercial">Commercial
                        </label>
                        <label for="education">
                            <input type="radio" name="shuffle-filter" id="education" value="education">Education
                        </label>
                        <label for="government">
                            <input type="radio" name="shuffle-filter" id="government" value="government">Government
                        </label>
                        <label for="infrastructure">
                            <input type="radio" name="shuffle-filter" id="infrastructure"
                                value="infrastructure">Infrastructure
                        </label>
                        <label for="residential">
                            <input type="radio" name="shuffle-filter" id="residential" value="residential">Residential
                        </label>
                        <label for="healthcare">
                            <input type="radio" name="shuffle-filter" id="healthcare" value="healthcare">Healthcare
                        </label>
                    </div><!-- project filter end -->


                    <div class="row shuffle-wrapper">
                        <div class="col-1 shuffle-sizer"></div>

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;government&quot;,&quot;healthcare&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="{{ asset('assets') }}/images/projects/project1.jpg">
                                    <img class="img-fluid" src="{{ asset('assets') }}/images/projects/project1.jpg"
                                        alt="project-image">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="{{ url('projects/id') }}">Capital Teltway Building</a>
                                        </h3>
                                        <p class="project-cat">Commercial, Interiors</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 1 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;healthcare&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="{{ asset('assets') }}/images/projects/project2.jpg">
                                    <img class="img-fluid" src="{{ asset('assets') }}/images/projects/project2.jpg"
                                        alt="project-image">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="{{ url('projects/id') }}">Ghum Touch Hospital</a>
                                        </h3>
                                        <p class="project-cat">Healthcare</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 2 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;infrastructure&quot;,&quot;commercial&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="{{ asset('assets') }}/images/projects/project3.jpg">
                                    <img class="img-fluid" src="{{ asset('assets') }}/images/projects/project3.jpg"
                                        alt="project-image">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="{{ url('projects/id') }}">TNT East Facility</a>
                                        </h3>
                                        <p class="project-cat">Government</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 3 end -->

                        {{-- <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;education&quot;,&quot;infrastructure&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="{{ asset('assets') }}/images/projects/project4.jpg">
                                    <img class="img-fluid" src="{{ asset('assets') }}/images/projects/project4.jpg"
                                        alt="project-image">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="{{ url('projects/id') }}">Narriot Headquarters</a>
                                        </h3>
                                        <p class="project-cat">Infrastructure</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 4 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;infrastructure&quot;,&quot;education&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="{{ asset('assets') }}/images/projects/project5.jpg">
                                    <img class="img-fluid" src="{{ asset('assets') }}/images/projects/project5.jpg"
                                        alt="project-image">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="{{ url('projects/id') }}">Kalas Metrorail</a>
                                        </h3>
                                        <p class="project-cat">Infrastructure</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 5 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;residential&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="{{ asset('assets') }}/images/projects/project6.jpg">
                                    <img class="img-fluid" src="{{ asset('assets') }}/images/projects/project6.jpg"
                                        alt="project-image">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="{{ url('projects/id') }}">Ancraft Avenue House</a>
                                        </h3>
                                        <p class="project-cat">Residential</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 6 end --> --}}
                    </div><!-- shuffle end -->
                </div>

                <div class="col-12">
                    <div class="general-btn text-center">
                        <a class="btn btn-primary" id="btnAllProject" href="?all">View All Projects</a>
                    </div>
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
