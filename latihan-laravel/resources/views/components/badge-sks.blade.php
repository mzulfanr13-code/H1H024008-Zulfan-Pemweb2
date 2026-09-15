@props(['sks'])
@php
    // Jika SKS >= 3 gunakan warna hijau (success), jika di bawah 3 gunakan kuning (warning)
    $warna = $sks >= 3 ? 'text-bg-success' : 'text-bg-warning';
@endphp

<span class="badge {{ $warna }}">{{ $sks }} SKS</span>