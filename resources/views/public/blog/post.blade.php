@extends('layouts.public.master')

@section('content')

<section id="main-container" class="main-container">

    <div class="container">
        <div class="row">

            <!-- POST -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="post-content post-single">
                    <div class="post-media post-image">
                        <img loading="lazy" src="{{ (isset($post->thumbnail) ? Storage::url($post->thumbnail) : asset('assets/images/news/news1.jpg')) }}" class="img-fluid" alt="post-image">
                    </div>

                    <div class="post-body">
                        <div class="entry-header">
                            <div class="post-meta">
                                <span class="post-author">
                                    <i class="far fa-user"></i><a href="#"> {{ $post->users->name }}</a>
                                </span>
                                <span class="post-meta-date"><i class="far fa-calendar"></i> {{ \Carbon\Carbon::now('Asia/Jakarta')->parse($post->created_at)->translatedFormat('l, d F Y') }}</span>
                            </div>
                            <h2 class="entry-title">
                                {{ $post->title }}
                            </h2>
                        </div>

                        <div class="entry-content">
                            {!! $post->content !!}
                        </div>

                    </div>
                </div>
            </div>

            <!-- RECENT POST & CATEGORIES -->
            <div class="col-lg-4">
                <x-public.sidebarblog :recentposts="$recentposts" :kategori="$kategori"></x-public.sidebarblog>
            </div><!-- Sidebar Col end -->

        </div><!-- Main row end -->

    </div>
</section>

@endsection