@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <section class="grid lg:grid-cols-[61.1%_1fr] overflow-hidden">
        <div class="relative z-10 bg-emerald-500 text-black px-5 lg:px-12 py-14 min-h-[320px] lg:min-h-[560px] flex flex-col justify-between">
            <p class="muncul text-xl lg:text-2xl">{{ $profil['jabatan'] }}</p>
            <h1 class="muncul judul judul-profil break-words">{{ $username }}</h1>

            <x-ombak class="kanan" />
        </div>

        <div class="px-5 lg:px-16 py-14 flex flex-col justify-center gap-12">
            <div class="muncul">
                <p class="text-[15px] text-zinc-400">Bertugas sejak</p>
                <p class="mt-2.5 text-2xl lg:text-[26px] leading-9">{{ $profil['bergabung'] }}</p>
            </div>
            <div class="muncul" style="--jeda: 100ms">
                <p class="text-[15px] text-zinc-400">Pelatihan gizi</p>
                <p class="mt-2.5 text-2xl lg:text-[26px] leading-9">{{ $profil['pelatihanGizi'] }}</p>
            </div>
        </div>
    </section>


    <section class="px-5 lg:px-12 py-[72px] grid lg:grid-cols-[400px_1fr] gap-10 lg:gap-16">
        <div class="muncul">
            <h2 class="judul text-4xl lg:text-[56px] lg:leading-[64px]">Dokumen yang kamu tanda tangani</h2>
            <p class="mt-4 text-zinc-400">Semuanya sah secara administrasi.</p>
        </div>

        <ul>
            @foreach ($riwayatTandaTangan as $dokumen)
                <li class="muncul grid sm:grid-cols-[140px_1fr] gap-x-8 gap-y-1 py-6 border-b border-zinc-800" style="--jeda: {{ $loop->index * 80 }}ms">
                    <span class="text-zinc-400">{{ $dokumen['tanggal'] }}</span>
                    <div>
                        <p class="text-lg leading-7">{{ $dokumen['dokumen'] }}</p>
                        <p class="mt-1.5 leading-7 text-zinc-400">{{ $dokumen['catatan'] }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
