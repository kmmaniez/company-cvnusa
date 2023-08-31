@props(['datacarousel'])

<div class="banner-carousel banner-carousel-1 mb-0">

    @forelse ($datacarousel as $carousel)
    <div class="banner-carousel-item" style="background-image:url({{ ($carousel->image) ? Storage::url($carousel->image) : url('assets/images/slider-main/bg1.jpg') }})">
        <div class="slider-content">
            <div class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-md-12 text-center">
                        <h2 class="slide-title" data-animation-in="slideInLeft">{{ $carousel->slide_title }}</h2>
                        <h3 class="slide-sub-title" data-animation-in="slideInRight">{{ $carousel->slide_subtitle }}</h3>
                        <p class="slider-description lead" data-animation-in="slideInRight">{{ $carousel->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="banner-carousel-item" style="background-image:url('assets/images/slider-main/bg1.jpg')">
        <div class="slider-content">
            <div class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-md-12 text-center">
                        <h2 class="slide-title" data-animation-in="slideInLeft">Title</h2>
                        <h3 class="slide-sub-title" data-animation-in="slideInRight">SubTitle</h3>
                        <p class="slider-description lead" data-animation-in="slideInRight">Description</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforelse

</div>