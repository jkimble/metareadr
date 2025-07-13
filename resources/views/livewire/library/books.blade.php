<div>
    <h1 class="text-2xl font-bold mb-4">All Saved Books</h1>

    <div class="bg-gray-800 p-4 rounded-lg">
        @if($books->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($books as $book)
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <h2 class="text-xl font-bold text-white">{{ $book->title }}</h2>
                        @if(isset($book->author_names))
                            <p class="text-gray-300">
                                by {{ is_array($book->author_names) ? implode(', ', array_slice($book->author_names, 0, 2)) : $book->author_names }}
                            </p>
                        @endif
                        @if($book->first_publish_year)
                            <p class="text-gray-300">Published: {{ $book->first_publish_year }}</p>
                        @endif
                        <div class="flex flex-row gap-2 mt-4">
                            <a class="btn btn-xs btn-primary" wire:click="showBookInfo({{ $book->id }})">Info</a>
                            <a class="btn btn-xs btn-danger" wire:confirm="Delete book?"
                               wire:click="removeBook({{ $book->id }})">Remove</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $books->links() }}
            </div>
        @else
            <p class="text-white text-center py-8">No books saved in your library.</p>
            <div class="flex justify-center">
                <a href="{{ route('search') }}" class="btn btn-primary">Search for Books</a>
            </div>
        @endif
    </div>

    @if($bookInfo)
        <div x-data="{ showModal: true }"
             x-on:close-modal.window="$wire.set('bookInfo', null)"
             class="book-modal">
            <x-library.book-modal :book="$bookInfo"/>
        </div>
    @endif
</div>
