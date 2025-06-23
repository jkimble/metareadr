@props(['author'])

<article class="flex-[0_1_32%] mb-4 p-4 bg-gray-800 text-white rounded">
    <h3 class="text-xl font-bold">{{ $author['name'] }}</h3>
    @if(!empty($author['top_work'] ))
        <p class="text-sm font-bold">
            Top Work:
            <span class="italic">{{ $author['top_work'] }}</span>
        </p>
    @endif
    <p class="text-sm">Rating: {{ round($author['ratings_average'], 2) }}</p>
</article>
