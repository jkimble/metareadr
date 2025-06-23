@props(['author'])

<article
    class="flex-[0_1_32%] mb-4 p-4 bg-gray-800 border border-gray-800 text-white rounded hover:border-teal-500 transition">
    <h3 class="text-xl font-bold">{{ $author['name'] }}</h3>
    @if(!empty($author['top_work'] ))
        <p class="text-sm font-bold">
            Top Work:
            <span class="italic">{{ $author['top_work'] }}</span>
        </p>
    @endif
    <p class="text-sm">Rating: {{ round($author['ratings_average'], 2) }}</p>
    <div class="flex flex-row flex-nowrap gap-2 mt-4">
        <x-content.button styling="secondary" class="btn-xs">
            <x-icons.book/>
            View Works
        </x-content.button>
        <x-content.button styling="primary" class="btn-xs">
            <x-icons.heart/>
            Add Author to Library
        </x-content.button>
    </div>
</article>
