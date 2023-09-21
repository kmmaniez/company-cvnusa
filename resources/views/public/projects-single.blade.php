@extends('layouts.public.master')

@section('content')
    <div id="banner-area" class="banner-area" style="background-image:url({{ url('assets/images/banner/banner1.jpg') }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">Project {{ $data->nama_project }}</h1>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <section id="main-container" class="main-container">
        <div class="container">

            <div class="row">
                <div class="col-lg-8">

                    <div id="page-slider" class="page-slider small-bg">

                        @foreach (json_decode($data->gambar_project) as $gambar)
                        <div class="item">
                            <img loading="lazy" style="width: max-content; height: 600px;" class="img-fluid object-fit-cover" src="{{ Storage::url($gambar) }}"
                                alt="project-image" />
                        </div>
                        @endforeach
                    </div>

                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">

                    <h3 class="column-title mrt-0">{{ $data->nama_project }}</h3>
                    <p>{{ $data->keterangan_project }}</p>

                    <ul class="project-info list-unstyled">
                        <li>
                            <p class="project-info-label">Client</p>
                            <p class="project-info-content">Pransbay Powers Authority</p>
                        </li>
                        <li>
                            <p class="project-info-label">Year Completed</p>
                            <p class="project-info-content">{{ $data->finish_date }}</p>
                        </li>
                        <li>
                            <p class="project-info-label">Categories</p>
                            <p class="project-info-content">Commercial, Interiors</p>
                        </li>
                    </ul>

                </div><!-- Content col end -->

            </div><!-- Row end -->

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
