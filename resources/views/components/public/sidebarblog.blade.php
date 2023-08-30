@props(['recentposts','kategori'])

<div class="sidebar sidebar-right">

    <div class="widget recent-posts">
        <h3 class="widget-title">Postingan Terbaru</h3>
        <ul class="list-unstyled">
        @foreach ($recentposts as $post)
            <li class="d-flex align-items-center">
                <div class="posts-thumb">
                    <a href="{{ route('public.post.detail', $post->slug) }}">
                        <img loading="lazy" alt="img" src="{{ (isset($post->thumbnail) ? Storage::url($post->thumbnail) : asset('assets/images/news/news1.jpg')) }}">
                    </a>
                </div>
                <div class="post-info">
                    <h4 class="entry-title">
                        <a href="{{ route('public.post.detail', $post->slug) }}">{{ $post->title }}</a>
                    </h4>
                </div>
            </li>
        @endforeach
        </ul>
    </div>

    <div class="widget">
        <h3 class="widget-title">Kategori</h3>
        <ul class="arrow nav nav-tabs">
        @foreach ($kategori as $kat)
            <li><a href="?kategori={{ $kat->nama_kategori }}">{{ $kat->nama_kategori }}</a></li>
        @endforeach
        </ul>
    </div>

</div>