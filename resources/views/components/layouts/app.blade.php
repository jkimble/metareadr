<x-layouts.app.header :title="$title ?? null">
    <div class="container max-w-7xl mx-auto mt-20 px-8">
        {{ $slot }}
        <div class="flex flex-row justify-between mt-4">
            @if(!request()->routeIs('home'))
                <x-content.button styling="secondary" :link="true" href="{{ route('home') }}">
                    <x-icons.book-search/>
                    Back to Search
                </x-content.button>
            @endif
            <div class="spacer"></div>
            <x-content.button styling="primary" :link="true" href="{{ route('login') }}">
                <x-icons.user/>
                {{ Auth::check() ? 'Account' : 'Log In' }}
            </x-content.button>
        </div>
    </div>
</x-layouts.app.header>
