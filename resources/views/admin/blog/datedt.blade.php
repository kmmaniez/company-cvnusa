@props(['created','updated'])

<span class="badge badge-primary p-2">Dibuat {{ \Carbon\Carbon::now('Asia/Jakarta')->parse($created)->translatedFormat('l, d F Y') }}</span>
<br>

@if (isset($updated))
<span class="badge badge-secondary p-2 mt-1">Diupdate {{ \Carbon\Carbon::now('Asia/Jakarta')->parse($updated)->translatedFormat('l, d F Y') }}</span>
@endif
