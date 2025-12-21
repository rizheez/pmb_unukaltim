<x-mail::message>
    # Selamat, {{ $student->name }}! 🎉

    Kami dengan senang hati memberitahukan bahwa Anda **diterima** sebagai calon mahasiswa baru di:

    <x-mail::panel>
        **Program Studi:** {{ $programStudiName }}

        **Universitas Nahdlatul Ulama Kalimantan Timur (UNUK Kaltim)**
    </x-mail::panel>

    ## Langkah Selanjutnya

    Silakan lakukan **daftar ulang** untuk mengkonfirmasi penerimaan Anda. Informasi lebih lanjut mengenai jadwal dan
    prosedur daftar ulang akan diinformasikan melalui website dan email berikutnya.

    <x-mail::button :url="config('app.url') . '/login'">
        Masuk ke Portal PMB
    </x-mail::button>

    Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.

    Salam,<br>
    **Panitia PMB**<br>
    {{ config('app.name') }}
</x-mail::message>
