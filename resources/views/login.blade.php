@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <div class="min-h-screen grid lg:grid-cols-[61.1%_1fr] overflow-hidden">


        <section class="relative z-10 bg-emerald-500 text-black p-5 lg:p-12 flex items-center gap-4 lg:gap-10">
            <p class="logo-jp self-start w-8 lg:w-[60px] text-3xl lg:text-5xl break-all" aria-label="OMPRENKMBG">マエムビージー</p>

            <h1 class="judul judul-login muncul">Makan gratis, rasa seadanya</h1>

            <x-ombak class="kanan" />
        </section>


        <section class="px-5 py-12 lg:px-16 flex flex-col justify-center">
            <h2 class="judul text-center text-[64px] leading-[72px] mb-14">Login</h2>

            @if (session('pesan'))
                <p class="mb-8 text-emerald-500">{{ session('pesan') }}</p>
            @endif

            @if ($errors->any())
                <div class="mb-8 text-red-400">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.proses') }}" method="POST">
                @csrf

                <div class="mb-9">
                    <label for="username" class="block text-[15px] text-zinc-400">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" autocomplete="username"
                           class="mt-3 block w-full h-12 bg-transparent border-b-2 border-zinc-50 outline-none transition-colors focus:border-emerald-500">
                </div>

                <div class="mb-9">
                    <label for="password" class="block text-[15px] text-zinc-400">Password</label>
                    <input type="password" id="password" name="password" autocomplete="current-password"
                           class="mt-3 block w-full h-12 bg-transparent border-b-2 border-zinc-50 outline-none transition-colors focus:border-emerald-500">
                </div>

                <button type="submit" class="tombol-cair judul mt-2 w-full h-[68px] bg-emerald-500 text-black text-3xl">
                    Masuk
                </button>
            </form>

            <p class="mt-5 text-sm text-zinc-500">Password dicek. Bahan makanannya belum.</p>
        </section>
    </div>
@endsection
