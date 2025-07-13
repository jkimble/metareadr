<div>
    <h1 class="text-2xl font-bold mb-4">All Saved Authors</h1>

    <div class="bg-gray-800 p-4 rounded-lg">
        @if($authors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($authors as $author)
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <h2 class="text-xl font-bold text-white">{{ $author->name }}</h2>
                        <div class="flex flex-row items-center flex-nowrap gap-1 text-white">
                            {{ round($author->ratings_average, 1) }}
                            <span class="text-teal-500">
                                <x-icons.star/>
                            </span>
                        </div>
                        @if($author->top_work)
                            <p class="text-gray-300 mt-2">Top work: {{ $author->top_work }}</p>
                        @endif
                        <div class="flex flex-row gap-2 mt-4">
                            <a class="btn btn-xs btn-primary" wire:click="showAuthorInfo({{ $author->id }})">Info</a>
                            <a class="btn btn-xs btn-danger" wire:confirm="Delete author?"
                               wire:click="removeAuthor({{ $author->id }})">Remove</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $authors->links() }}
            </div>
        @else
            <p class="text-white text-center py-8">No authors saved in your library.</p>
            <div class="flex justify-center">
                <a href="{{ route('search') }}" class="btn btn-primary">Search for Authors</a>
            </div>
        @endif
    </div>

    @if($authorInfo)
        <div x-data="{ showModal: true }"
             x-on:close-modal.window="$wire.set('authorInfo', null)"
             class="author-modal">
            <x-library.author-modal :authorInfo="$authorInfo"/>
        </div>
    @endif
</div>
