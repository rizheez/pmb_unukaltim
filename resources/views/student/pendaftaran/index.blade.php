@extends('layouts.student')

@section('content')
    <div class="space-y-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Pendaftaran
                </h2>
            </div>
        </div>

        <!-- Pendaftaran Form -->
        <div class="bg-white shadow rounded-lg p-6">
            @if ($registration && $registration->status == 'submitted')
                <div class="text-center py-8">
                    <i data-lucide="check-circle" class="mx-auto h-12 w-12 text-green-500"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Pendaftaran Berhasil Dikirim</h3>
                    <p class="mt-1 text-sm text-gray-500">Anda telah mendaftar. Silakan tunggu informasi selanjutnya.</p>
                </div>
            @else
                <form action="{{ route('student.pendaftaran.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="registration_type" class="block text-sm font-medium text-gray-700">Jenis
                                Pendaftaran</label>
                            <select name="registration_type" id="registration_type"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Jenis Pendaftaran</option>
                                <option value="Reguler">Reguler</option>
                                <option value="CBT">CBT (Computer Based Test)</option>
                            </select>
                            @error('registration_type')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        @php
                            $prodi = [
                                'Arsitektur',
                                'Hubungan Internasional',
                                'Desain Interior',
                                'Teknologi Industri Pertanian',
                                'Pendidikan Anak Usia Dini',
                                'Farmasi',
                                'Ilmu Komunikasi',
                                'Akuntansi',
                                'Teknik Industri',
                                'Teknik Informatika',
                            ];
                        @endphp

                        <!-- Program Studi Pilihan -->
                        <div class="sm:col-span-2">
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Pilihan Program Studi (Maksimal 2)</h4>
                        </div>

                        <div>
                            <label for="choice_1" class="block text-sm font-medium text-gray-700">Pilihan 1</label>
                            <select name="choice_1" id="choice_1"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Program Studi 1</option>
                                @foreach ($prodi as $p)
                                    <option value="{{ $p }}">{{ $p }}</option>
                                @endforeach
                            </select>
                            @error('choice_1')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="choice_2" class="block text-sm font-medium text-gray-700">Pilihan 2
                                (Opsional)</label>
                            <select name="choice_2" id="choice_2"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Program Studi 2</option>
                                @foreach ($prodi as $p)
                                    <option value="{{ $p }}">{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-gray-50 border border-gray-200 rounded-md p-4 mt-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i data-lucide="info" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Persyaratan Pendaftaran</h3>
                                <div class="mt-2 text-sm text-gray-500">
                                    <ol class="list-decimal pl-5 space-y-1">
                                        <li>Warga Negara Indonesia</li>
                                        <li>Warga Negara Asing yang memiliki izin tinggal di Indonesia</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            Lanjut Pendaftaran
                        </button>
                    </div>
                </form>
            @endif
        </div>

        <!-- Riwayat Pendaftaran -->
        <div class="mt-8">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Riwayat Pendaftaran</h3>
            @if ($registration)
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tanggal</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Jenis</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Pilihan 1</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $registration->updated_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $registration->registration_type }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $registration->choice_1 }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    {{ ucfirst($registration->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white shadow rounded-lg p-6 text-center text-gray-500">
                    <i data-lucide="history" class="h-10 w-10 mx-auto mb-2 opacity-50"></i>
                    <p>Belum ada riwayat pendaftaran :(</p>
                </div>
            @endif
        </div>
    </div>
@endsection
