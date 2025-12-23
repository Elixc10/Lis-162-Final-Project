<nav class="flex justify-center gap-4 px-3">
    @auth
        <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Dashboard
        </a>
    @else
        <a href="{{ route('login') }}"
           class="inline-flex items-center rounded-lg px-4 py-2 border border-gray-200 shadow-sm text-black bg-transparent hover:bg-gray-100 active:bg-gray-200 transition ease-in-out duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FF2D20] dark:border-neutral-700 dark:text-white dark:bg-transparent dark:hover:bg-white/10 dark:active:bg-white/20">
            Log in
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}"
               class="inline-flex items-center rounded-lg px-4 py-2 border border-gray-200 shadow-sm text-black bg-transparent hover:bg-gray-100 active:bg-gray-200 transition ease-in-out duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FF2D20] dark:border-neutral-700 dark:text-white dark:bg-transparent dark:hover:bg-white/10 dark:active:bg-white/20">
                Register
            </a>
        @endif
    @endauth
</nav>
