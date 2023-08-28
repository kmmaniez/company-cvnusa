@props(['gambar'])
<img src="{{ 
    ($gambar != NULL) ? Storage::url($gambar) : url("assets/images/services/service1.jpg") }}" 
    style="object-fit: cover;" width="auto" height="100" alt="gambar-service"
>