<x-mail::message>
# Pemberitahuan Status Pendaftaran

Yth. {{ $student->name }},

Terima kasih atas ketertarikan Anda untuk bergabung dengan Universitas Nahdlatul Ulama Kalimantan Timur (UNUK
Kaltim).

Setelah melalui proses seleksi, dengan berat hati kami sampaikan bahwa pendaftaran Anda **tidak dapat kami terima**
pada periode ini.

<x-mail::panel>
**Alasan:**

{{ $reason }}
</x-mail::panel>

## Jangan Berkecil Hati

Keputusan ini tidak mengurangi potensi dan kemampuan Anda. Kami mendorong Anda untuk:

- Memperbaiki dokumen atau persyaratan yang belum lengkap
- Mencoba mendaftar kembali pada periode berikutnya
- Menghubungi kami jika memerlukan klarifikasi

Jika Anda memiliki pertanyaan, silakan hubungi panitia PMB.

Salam hormat,<br>
**Panitia PMB UNU Kaltim**<br>
{{ config('app.name') }}
</x-mail::message>
