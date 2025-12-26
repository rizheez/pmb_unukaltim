<x-mail::message>
# Dokumen Perlu Diperbaiki

Yth. {{ $student->name }},

Kami telah memeriksa dokumen pendaftaran Anda. Mohon maaf, terdapat {{ count($rejectedDocuments) }} dokumen yang **perlu diperbaiki** atau **diunggah ulang**:

@foreach ($rejectedDocuments as $doc)
<x-mail::panel>
**Dokumen:** {{ $doc['label'] }}

@if ($doc['notes'])
**Catatan dari Tim Verifikasi:**

{{ $doc['notes'] }}
@endif
</x-mail::panel>
@endforeach

## Langkah yang Perlu Dilakukan

1. Login ke portal PMB menggunakan akun Anda
2. Buka halaman **Biodata**
3. Perbaiki atau unggah ulang dokumen yang ditandai
4. Pastikan dokumen sesuai dengan ketentuan yang berlaku

<x-mail::button :url="config('app.url') . '/login'">
Perbaiki Dokumen Sekarang
</x-mail::button>

Jika Anda memiliki pertanyaan, silakan hubungi panitia PMB.

Salam,<br>
**Tim Verifikasi PMB UNU Kaltim**<br>
{{ config('app.name') }}
</x-mail::message>
