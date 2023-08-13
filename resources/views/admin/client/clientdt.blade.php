@props(['logo'])

<img src="{{ Storage::url($logo) }}" style="object-fit: cover;" width="300" height="150" alt="client-logo">