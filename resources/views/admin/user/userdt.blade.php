@props(['name'])
<h5>
    @if ($name === "super")
    <span class="badge badge-danger p-2">{{ Str::ucfirst($name) }}</span>
    @elseif ($name === "admin")
    <span class="badge badge-primary p-2">{{ Str::ucfirst($name) }}</span>
    @else
    <span class="badge badge-default p-2">{{ Str::ucfirst($name) }}</span>
    @endif
</h5>