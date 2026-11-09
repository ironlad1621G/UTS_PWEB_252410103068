@props(['username'])

<header class="border-b border-zinc-800">
    <div class="px-5 lg:px-12 py-3 lg:h-20 flex flex-wrap items-center justify-between gap-x-6 gap-y-2">
        <a href="{{ route('dashboard', ['username' => $username]) }}" aria-label="OMPRENKMBG"
           class="logo-jp text-2xl lg:text-5xl text-emerald-500">マエムビージー</a>

        <nav class="order-last lg:order-none w-full lg:w-auto flex gap-6 lg:gap-10">
            <a href="{{ route('dashboard', ['username' => $username]) }}"
               class="{{ request()->routeIs('dashboard') ? 'text-emerald-500' : 'text-zinc-400 hover:text-white' }}">
                Dashboard
            </a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}"
               class="{{ request()->routeIs('pengelolaan') ? 'text-emerald-500' : 'text-zinc-400 hover:text-white' }}">
                Pengelolaan
            </a>
            <a href="{{ route('profile', ['username' => $username]) }}"
               class="{{ request()->routeIs('profile') ? 'text-emerald-500' : 'text-zinc-400 hover:text-white' }}">
                Profil
            </a>
        </nav>

        <div class="flex items-center gap-6">
            <span class="hidden sm:inline text-zinc-400">{{ $username }}</span>
            <a href="{{ route('logout') }}" class="tombol-cair border border-zinc-600 px-[18px] py-2.5 hover:text-black">
                Keluar
            </a>
        </div>
    </div>
</header>
