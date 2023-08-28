@extends('layouts.public.master')

@section('content')

<section id="main-container" class="main-container">
    {{-- @dump($post) --}}
    <div class="container">
        <div class="row">

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
                        </div><!-- header end -->

                        <div class="entry-content">
                            {!! $post->content !!}
                        </div>

                    </div><!-- post-body end -->
                </div><!-- post content end -->


            </div><!-- Content Col end -->

            <div class="col-lg-4">

                <div class="sidebar sidebar-right">
                    <div class="widget recent-posts">
                        <h3 class="widget-title">Recent Posts</h3>
                        <ul class="list-unstyled">
                            @foreach ($recentposts as $post)
                                <li class="d-flex align-items-center">
                                    <div class="posts-thumb">
                                        <a href="{{ route('public.post.detail', $post->slug) }}"><img loading="lazy" alt="img"
                                                src="{{ (isset($post->thumbnail) ? Storage::url($post->thumbnail) : asset('assets/images/news/news1.jpg')) }}"></a>
                                    </div>
                                    <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="{{ route('public.post.detail', $post->slug) }}">{{ $post->title }}</a>
                                        </h4>
                                    </div>
                                </li>
                            @endforeach
                            
                        </ul>

                    </div><!-- Recent post end -->

                    <div class="widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="arrow nav nav-tabs">
                            @foreach ($kategori as $kat)
                            <li><a href="#">{{ $kat->nama_kategori }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- Categories end -->

                </div><!-- Sidebar end -->
            </div><!-- Sidebar Col end -->

        </div><!-- Main row end -->

    </div>
</section>

@endsection