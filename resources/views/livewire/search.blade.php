<div>
    <h1>
        Search for "{{ $query ?? 'undefined' }}"
        <span class="text-lg italic block">{{ $author ? 'by: "' . $author . '"' : '' }}</span>
    </h1>
    <x-content.container>
        @if($results->isNotEmpty())
            <div class="search-results flex flex-row flex-wrap gap-4">
                @if($type == 'book')
                    @foreach($results as $book)
                        <x-library.book-card :savedBooks="$savedBooks" :book="$book"
                                             wire:key="book-{{ $book['key'] }}"/>
                    @endforeach
                @else
                    @foreach($results as $author)
                        <x-library.author-card
                            :savedAuthors="$savedAuthors"
                            :author="$author"
                            :authorInfo="$currentAuthorKey === $author['key'] ? $authorInfo : []"
                            wire:key="author-{{ $author['key'] }}-{{ $currentAuthorKey === $author['key'] ? 'info' : 'no-info' }}"/>
                    @endforeach
                @endif
            </div>
            @if($hasMorePages)
                <div class="flex flex-row justify-center items-center mt-4 text-center gap-4">
                    <button wire:click="loadMore"
                            class="btn btn-primary">
                        Load More Results
                    </button>
                    <div wire:loading class="flex justify-center py-4 text-white">
                        <x-icons.spinner/>
                    </div>
                </div>
            @endif
        @else
            <div class="no-results">
                <p>No results found for your search. Please try a different query.</p>
            </div>
        @endif
    </x-content.container>
</div>
