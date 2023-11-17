@extends('layouts.public.master')
@push('stylesheet')
    <style>
        .ts-service-box:hover {
            transition: transform;
            transition-duration: 200ms;
            transition-delay: 50ms;
            transform: translateY(-12px);
            cursor: pointer;
        }

        .action-style-box {
            box-shadow: 0px 0px 16px rgba(120, 120, 120, 0.515);
        }
    </style>
@endpush

@section('content')
    <x-public.carousel :datacarousel="$carousels"></x-public.carousel>

    <section class="call-to-action-box no-padding">
        <div class="container">
            <div class="action-style-box ">
                <div class="row align-items-center">
                    <div class="col-md-8 text-center text-md-left">
                        <div class="call-to-action-text">
                            <h3 class="action-title">We understand your needs on construction</h3>
                        </div>
                    </div><!-- Col end -->
                    <div class="col-md-4 text-center text-md-right mt-3 mt-md-0">
                        <div class="call-to-action-btn">
                            <a class="btn btn-dark" href="#project-area">See our projects</a>
                        </div>
                    </div><!-- col end -->
                </div><!-- row end -->
            </div><!-- Action style box -->
        </div><!-- Container end -->
    </section>

    <!-- Service -->
    {{-- DONE --}}
    <section id="ts-service-area" class="ts-service-area pb-0">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">We Are Specialists In</h2>
                    <h3 class="section-sub-title">What We Do</h3>
                </div>
            </div>
            <!--/ Title row end -->
            <div class="row">

                @foreach ($services as $service)
                    <div class="col-lg-4">
                        <div class="ts-service-box d-flex">
                            <div class="ts-service-box-img">
                                <img loading="lazy" src="{{ url('assets/images/icon-image/service-icon1.png') }}"
                                    alt="service-icon">
                            </div>
                            <div class="ts-service-box-info">
                                <h3 class="service-box-title">{{ $service->title }}</h3>
                                <p>{{ $service->description }}</p>
                            </div>
                        </div><!-- Service 1 end -->
                    </div>
                @endforeach

            </div><!-- Content row end -->

        </div>
        <!--/ Container end -->
    </section>

    <!-- Detail Project Company -->
    {{-- DONE --}}
    <section id="facts" class="facts-area dark-bg">
        <div class="container">
            <div class="facts-wrapper">
                <div class="row">

                    <!-- TOTAL PROJECT -->
                    <div class="col-md-4 col-sm-6 ts-facts">
                        <div class="ts-facts-img">
                            <img loading="lazy" src="{{ url('assets/images/icon-image/fact1.png') }}" alt="facts-img">
                        </div>
                        <div class="ts-facts-content">
                            <h2 class="ts-facts-num"><span class="counterUp" data-count="{{ $totalproject }}">0</span>
                            </h2>
                            <h3 class="ts-facts-title">Total Projects</h3>
                        </div>
                    </div>

                    <!-- TOTAL STAFF -->
                    <div class="col-md-4 col-sm-6 ts-facts mt-5 mt-sm-0">
                        <div class="ts-facts-img">
                            <img loading="lazy" src="{{ url('assets/images/icon-image/fact2.png') }}" alt="facts-img">
                        </div>
                        <div class="ts-facts-content">
                            <h2 class="ts-facts-num"><span class="counterUp" data-count="{{ $totalstaff }}">0</span>
                            </h2>
                            <h3 class="ts-facts-title">Staff Members</h3>
                        </div>
                    </div>

                    <!-- TOTAL CLIENT -->
                    <div class="col-md-4 col-sm-6 ts-facts mt-5 mt-md-0">
                        <div class="ts-facts-img">
                            <img loading="lazy" src="{{ url('assets/images/icon-image/fact3.png') }}" alt="facts-img">
                        </div>
                        <div class="ts-facts-content">
                            <h2 class="ts-facts-num"><span class="counterUp" data-count="{{ $totalclient }}">0</span>
                            </h2>
                            <h3 class="ts-facts-title">Total Client</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- List Project -->
    <section id="project-area" class="project-area solid-bg">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="section-title">Work of Excellence</h2>
                    <h3 class="section-sub-title">Recent Projects</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">
                <div class="col-12">

                    <div class="row shuffle-wrapper">
                        <div class="col-1 shuffle-sizer"></div>
                        @foreach ($projects as $project)
                            <div class="col-lg-4 col-md-6 shuffle-item">
                                <div class="project-img-container">
                                    <a class="gallery-popup"
                                        href="{{ Storage::url($project->thumbnail) }}">
                                        <img class="img-fluid object-fit-cover" style="width: 200px;height:300px;"
                                            src="{{ Storage::url($project->thumbnail) }}"
                                            alt="project-image">
                                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                    </a>
                                    <div class="project-item-info">
                                        <div class="project-item-info-content">
                                            <h3 class="project-item-title">
                                                <a
                                                    href="{{ route('public.project-single', $project->slug) }}">{{ $project->nama_project }}</a>
                                            </h3>
                                            <p class="project-cat">Commercial, Interiors</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                @if (count($projects) > 0)
                <div class="col-12">
                    <div class="general-btn text-center">
                        <a class="btn btn-primary" href="{{ route('public.projects') }}">View All Projects</a>
                    </div>
                </div>
                @endif

            </div>
        </div>
        <!--/ Container end -->
    </section>

    <!-- Testimonial -->
    {{-- DONE --}}
    <x-public.clients :dataclient="$clients"></x-public.clients>

    <!-- SECTION BLOG -->
    {{-- done --}}
    <section id="news" class="news">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">Work of Excellence</h2>
                    <h3 class="section-sub-title">Recent Posts</h3>
                </div>
            </div>

            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="{{ route('public.post.detail', $post->slug) }}" class="latest-post-img">
                                    <img loading="lazy" class="img-fluid"
                                        src="{{ isset($post->thumbnail) ? Storage::url($post->thumbnail) : asset('assets/images/news/news2.jpg') }}"
                                        alt="img">
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="{{ route('public.post.detail', $post->slug) }}"
                                        class="d-inline-block">{{ $post->title }}</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i>
                                        {{ \Carbon\Carbon::now('Asia/Jakarta')->parse($post->created_at)->translatedFormat('l, d F Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (count($posts) > 0)
                <div class="general-btn text-center mt-4">
                    <a class="btn btn-primary" href="{{ route('public.post.all') }}">See All Posts</a>
                </div>
            @endif

        </div>
    </section>
@endsection
