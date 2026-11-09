@extends('layouts.app')

@section('title', 'Pengelolaan')

@section('content')
    <section class="px-5 lg:px-12 pt-16 pb-14 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-10">
        <h1 class="muncul judul judul-menu lg:w-[71%]">Menu minggu ini</h1>

        <div class="muncul lg:w-80 shrink-0 text-zinc-400" style="--jeda: 150ms">
            <p>Anggaran lima hari</p>
            <p class="judul mt-1.5 text-[56px] leading-[64px] text-zinc-50">Rp{{ number_format($totalAnggaran, 0, ',', '.') }}</p>
            <p class="mt-1.5">Yang jadi makanan</p>
            <p class="judul mt-1.5 text-[56px] leading-[64px] text-emerald-500">Rp{{ number_format($totalTerpakai, 0, ',', '.') }}</p>
        </div>
    </section>


    <section>
        @foreach ($menuMingguIni as $menu)
            <article class="baris muncul grid lg:grid-cols-[200px_1fr_180px_228px] lg:items-center gap-x-8 gap-y-3 px-5 lg:px-12 py-[26px] border-t border-zinc-800 text-base lg:text-lg leading-7 {{ $menu['status'] == 'ditarik' ? 'bg-emerald-500 text-black' : 'hover:bg-zinc-900' }}"
                     style="--jeda: {{ $loop->index * 80 }}ms">
                <h2 class="hari judul text-[60px] leading-[64px] {{ $menu['status'] == 'ditarik' ? 'text-black' : 'text-emerald-500' }}">{{ $menu['hari'] }}</h2>

                <div>
                    <p class="line-through {{ $menu['status'] == 'ditarik' ? 'text-emerald-900' : 'text-zinc-500' }}">{{ $menu['diProposal'] }}</p>
                    <p class="mt-1.5">{{ $menu['diOmpreng'] }}</p>
                </div>

                <p>Rp{{ number_format($menu['terpakai'], 0, ',', '.') }} / {{ number_format($menu['anggaran'], 0, ',', '.') }}</p>

                <p class="lg:text-right">
                    <x-status-menu :status="$menu['status']" />
                </p>
            </article>
        @endforeach
    </section>

    {{-- Daftar petugas dari array $petugas --}}
    <section class="px-5 lg:px-12 py-[72px] border-t border-zinc-800">
        <h2 class="muncul judul text-4xl lg:text-[56px] lg:leading-[64px]">Petugas dapur</h2>

        <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-5 gap-8">
            @foreach ($petugas as $orang)
                <div class="muncul" style="--jeda: {{ $loop->index * 80 }}ms">
                    <h3 class="judul text-[40px] leading-[44px]">{{ $orang['nama'] }}</h3>
                    <p class="mt-2.5 text-emerald-500">{{ $orang['tugas'] }}</p>
                    <p class="mt-2.5 text-[15px] leading-6 text-zinc-400">{{ $orang['catatan'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
