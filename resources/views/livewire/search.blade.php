<div>
    <h1>Search for "{{ $query ?? 'undefined' }}"</h1>
    <x-content.container>
        <div class="text-white">
            search results and other things here
        </div>
        @if($results->isNotEmpty())
            <div class="search-results flex flex-row flex-wrap gap-4">
                @foreach($results as $result)
                    <article class="flex-[32%] mb-4 p-4 bg-gray-800 rounded">
                        <h3 class="text-xl font-bold">{{ $result['title'] ?? 'Untitled' }}</h3>
                        @if(isset($result['author_name']))
                            <p class="text-gray-300">
                                Author: {{ is_array($result['author_name']) ? implode(', ', $result['author_name']) : $result['author_name'] }}</p>
                        @endif
                        @if(isset($result['first_publish_year']))
                            <p class="text-gray-300">Published: {{ $result['first_publish_year'] }}</p>
                        @endif
                    </article>
                @endforeach
            </div>
            @if($hasMorePages)
                <div class="flex flex-row justify-center mt-4 text-center">
                    <button wire:click="loadMore"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Load More Results
                    </button>
                </div>
            @endif
        @else
            <div class="no-results">
                <p>No results found for your search. Please try a different query.</p>
            </div>
        @endif
    </x-content.container>
</div>
