@props(['images'])
<img src="{{ (isset($images)) ? Storage::url($images) : asset('assets/images/banner/banner1.jpg') }}" style="object-fit: cover;" width="600" height="150" alt="wallpaper-image">