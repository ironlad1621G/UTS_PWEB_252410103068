@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <section class="relative bg-emerald-500 text-black px-5 lg:px-12 pt-14 pb-12">
        <p class="muncul text-lg lg:text-[22px]">Selamat bertugas, {{ $username }}</p>
        <h1 class="muncul judul judul-raksasa mt-2">Rp{{ number_format($ompreng['selisih'], 0, ',', '.') }}</h1>
        <p class="muncul text-lg lg:text-2xl leading-[34px]">hilang dari setiap porsi. Sedang dicari ke mana.</p>

        <x-ombak class="bawah" />
    </section>


    <section class="px-5 lg:px-12 pt-24 pb-[72px]">
        <h2 class="muncul judul text-4xl lg:text-[56px] lg:leading-[64px]">Ke mana Rp{{ number_format($ompreng['anggaranPerPorsi'], 0, ',', '.') }} per porsi pergi</h2>

        <div class="batang mt-9 flex min-h-[148px] bg-zinc-800">
            <div class="isi-batang bg-emerald-500 text-black p-4 lg:p-6 flex flex-col justify-between" style="width: {{ $ompreng['persen'] }}%">
                <p class="judul text-4xl lg:text-[56px] lg:leading-[60px]">Rp{{ number_format($ompreng['sampaiDiOmpreng'], 0, ',', '.') }}</p>
                <p class="text-sm lg:text-base">jadi makanan di ompreng</p>
            </div>
            <div class="flex-1 p-4 lg:p-6 flex flex-col justify-end">
                <p class="text-sm lg:text-base">sedang dicari ke mana</p>
            </div>
        </div>
    </section>


    <section class="grid lg:grid-cols-3 border-y border-zinc-800">
        <div class="muncul px-5 lg:px-12 py-11 border-b lg:border-b-0 lg:border-r border-zinc-800">
            <p class="judul text-[88px] leading-[92px]">{{ number_format($ompreng['porsi'], 0, ',', '.') }}</p>
            <p class="mt-3.5 text-zinc-400 leading-[26px]">Ompreng keluar dari dapur. Yang dihitung ulang belum ada.</p>
        </div>
        <div class="muncul px-5 lg:px-12 py-11 border-b lg:border-b-0 lg:border-r border-zinc-800" style="--jeda: 100ms">
            <p class="judul text-[88px] leading-[92px]">{{ $ompreng['jamNasi'] }} &ndash; {{ $ompreng['jamLauk'] }}</p>
            <p class="mt-3.5 text-zinc-400 leading-[26px]">Nasi tiba jam {{ $ompreng['jamNasi'] }}, lauk menyusul jam {{ $ompreng['jamLauk'] }}.</p>
        </div>
        <div class="muncul px-5 lg:px-12 py-11" style="--jeda: 200ms">
            <p class="judul text-[88px] leading-[92px] text-emerald-500">{{ $ompreng['insiden'] }}</p>
            <p class="mt-3.5 text-zinc-400 leading-[26px]">Siswa sakit perut minggu ini.</p>
        </div>
    </section>

    {{-- Catatan kejadian di dapur --}}
    <section class="px-5 lg:px-12 py-[72px] grid lg:grid-cols-[400px_1fr] gap-10 lg:gap-16">
        <h2 class="muncul judul text-4xl lg:text-[56px] lg:leading-[64px]">Catatan dapur hari ini</h2>

        <ul>
            @foreach ($kabarDapur as $kabar)
                <li class="muncul flex gap-5 lg:gap-8 py-[22px] border-b border-zinc-800 text-base lg:text-lg leading-7" style="--jeda: {{ $loop->index * 80 }}ms">
                    <span class="w-14 lg:w-[72px] shrink-0 text-emerald-500">{{ $kabar['jam'] }}</span>
                    <span>{{ $kabar['isi'] }}</span>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
