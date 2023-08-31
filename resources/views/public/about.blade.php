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

    <section id="main-container" class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>{{ isset($data[0]['tagline_title']) ? $data[0]['tagline_title'] : '-' }}</h3>
                    {!! isset($data[0]['tagline_content']) ? $data[0]['tagline_content'] : '.' !!}
                </div>
                <div class="col-lg-12 mt-5 text-justify">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>{{ isset($data[0]['title_vision']) ? $data[0]['title_vision'] : '-' }}</h3>
                            {!! isset($data[0]['content_vision']) ? $data[0]['content_vision'] : '.' !!}
                        </div>
                        <div class="col-lg-6">
                            <h3>{{ isset($data[0]['title_mision']) ? $data[0]['title_mision'] : '-' }}</h3>
                            <div class="content">
                                {!! isset($data[0]['content_mision']) ? $data[0]['content_mision'] : '.' !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- Content row end -->

        </div><!-- Container end -->
    </section><!-- Main container end -->

    <!-- ANGGOTA TEAM -->
    <section id="ts-team" class="ts-team">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="section-title">Team Service</h2>
                    <h3 class="section-sub-title">Professional Team</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <!-- SLIDER -->
            <div class="row">
                <div class="col-lg-12">
                    <div id="team-slide" class="team-slide">

                        @foreach ($teams as $anggota)
                        <div class="item">
                            <div class="ts-team-wrapper">
                                <div class="team-img-wrapper">
                                    <img loading="lazy" class="w-100" src="{{ $anggota->gambar_anggota ? url("photos/teams/$anggota->gambar_anggota") : asset('assets/images/team/team1.jpg') }}"
                                        alt="team-img">
                                </div>
                                <div class="ts-team-content">
                                    <h3 class="ts-name">{{ $anggota->nama_anggota }}</h3>
                                    <p class="ts-designation">{{ $anggota->jabatans->nama_jabatan }}</p>
                                    <div class="team-social-icons">
                                        <a target="_blank" href="https://www.facebook.com/{{ $anggota->url_facebook }}"><i class="fab fa-facebook-f"></i></a>
                                        <a target="_blank" href="https://www.twitter.com/{{ $anggota->url_twitter }}"><i class="fab fa-twitter"></i></a>
                                        <a target="_blank" href="{{ $anggota->url_linkedin }}"><i class="fab fa-linkedin"></i></a>
                                        <a target="_blank" href="https://www.instagram.com/{{ $anggota->url_instagram }}"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div><!-- Team slide end -->
                </div>
            </div>
            <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </section>
    <!--/ Team end -->
@endsection
