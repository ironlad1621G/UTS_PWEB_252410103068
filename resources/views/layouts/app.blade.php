<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen flex flex-col bg-black text-zinc-50 font-mono overflow-x-hidden">

    <div id="cairan" class="cairan" aria-hidden="true">
        <x-ombak class="atas" />
        <x-ombak class="bawah" />
    </div>

    @isset($username)
        <x-navbar :username="$username" />
    @endisset

    <main class="flex-1">
        @yield('content')
    </main>


    @isset($username)
        <x-footer />
    @endisset

</body>
</html>
