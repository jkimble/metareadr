<div>
    <h1>Search for "{{ $query ?? 'undefined' }}"</h1>
    <x-content.container>
        @if($results->isNotEmpty())
            <div class="search-results flex flex-row flex-wrap gap-4">
                @if($type == 'book')
                    @foreach($results as $book)
                        <x-library.book-card :savedBooks="$savedBooks" :book="$book"/>
                    @endforeach
                @else
                    @foreach($results as $author)
                        <x-library.author-card :savedAuthors="$savedAuthors" :author="$author"/>
                    @endforeach
                @endif
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
