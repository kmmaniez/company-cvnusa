@extends('layouts.public.master')

@section('content')

<section id="main-container" class="main-container">
    
    <div class="container">
        <div class="row">

            <!-- ALL POST & POST BY KATEGORI -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                @forelse ($posts as $post)
                <div class="post">
                    <div class="post-media post-image">
                        <img loading="lazy" src="{{ (isset($post->thumbnail) ? Storage::url($post->thumbnail) : asset('assets/images/news/news1.jpg')) }}" class="img-fluid" alt="post-image">
                    </div>

                    <div class="post-body">
                        <div class="entry-header">
                            <div class="post-meta">
                                <span class="post-author">
                                    <i class="far fa-user"></i><a href="{{ route('public.post.all') }}?penulis={{ $post->users->username }}"> {{ $post->users->name }}</a>
                                </span>
                                <span class="post-cat">
                                    <i class="far fa-folder-open"></i><a href="?kategori={{ $post->kategoris->nama_kategori }}"> {{ $post->kategoris->nama_kategori }}</a>
                                </span>
                                <span class="post-meta-date"><i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('l, d F Y') }}</span>
                            </div>
                            <h2 class="entry-title">
                                <a href="{{ route('public.post.detail', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                        </div>

                        <div class="entry-content">
                            {!! $post->content !!}
                        </div>

                        <div class="post-footer">
                            <a href="{{ route('public.post.detail', $post->slug) }}" class="btn btn-primary">Continue Reading</a>
                        </div>

                    </div>
                </div>

                @empty
                <div class="post">
                    <div class="post-body">
                        <div class="entry-header">
                            <h2 class="entry-title">
                                <span>Oops, postingan tidak ditemukan! <a href="{{ route('public.post.all') }}">kembali</a></span>
                            </h2>
                        </div>
                    </div>
                </div>

                @endforelse
                
                @if (empty(request()->has('kategori')) && empty(request()->has('penulis')))
                {{ $posts->links() }}
                @endif

            </div>
            
            <!-- RECENT POST & CATEGORIES -->
            <div class="col-lg-4">
                <x-public.sidebarblog :recentposts="$recentposts" :kategori="$kategori"></x-public.sidebarblog>
            </div>

        </div>

    </div>
</section>
@endsection
