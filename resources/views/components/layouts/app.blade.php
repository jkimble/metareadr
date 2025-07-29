<x-layouts.app.header :title="$title ?? null">
    <div class="container max-w-7xl mx-auto mt-8 md:mt-20 px-8">
        <a href="{{ route('home') }}">
            <h1 class="italic inline-block text-center border-4 border-teal-500 py-2 px-4">
                metareadr
            </h1>
        </a>
        {{ $slot }}
        <div class="flex flex-row justify-between mt-4">
            @if(!request()->routeIs('home'))
                <x-content.button styling="secondary" :link="true" href="{{ route('home') }}">
                    <x-icons.book-search/>
                    Back to Search
                </x-content.button>
            @endif
            <div class="spacer"></div>
            <div class="flex flex-row gap-4">
                @if(Auth::check())
                    <x-content.button styling="primary" :link="true" href="{{ route('library') }}">
                        <x-icons.book-account/>
                        My Library
                    </x-content.button>
                @endif
                <x-content.button styling="primary" :link="true"
                                  href="{{ Auth::check() ? route('settings.profile') : route('login') }}">
                    <x-icons.user/>
                    {{ Auth::check() ? 'Account' : 'Log In' }}
                </x-content.button>
            </div>
        </div>
    </div>
</x-layouts.app.header>
