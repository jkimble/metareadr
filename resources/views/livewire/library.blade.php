<div>
    <div class="w-full flex md:grid md:grid-cols-3 md:auto-rows-min gap-4 px-8 py-4 bg-gray-600">
        <div class="flex flex-col">
            <div class="bg-black rounded pt-4 text-white">
                <h2 class="font-bold text-2xl pb-2 px-4 border-b-2 border-b-teal-500">
                    Saved Authors <span class="text-sm font-black">({{ $authorTotal }})</span>
                </h2>
                @if($authors ?? null)
                    <x-library.author-list :authors="$authors"/>
                    <div class="px-4 pb-2 pt-3.5 mb-2 border-t-2 border-t-teal-500">
                        <a href="{{ route('library.authors') }}" class="btn btn-sm btn-primary !inline">
                            View All Authors
                        </a>
                    </div>
                @else
                    <div class="flex flex-col gap-4">
                        <p class="font-bold text-white text-xl">No authors added to library yet.</p>
                        <a href="{{ route('search') }}" class="btn btn-lg btn-primary text-center" role="link"
                           aria-label="Search for a new author">Search for a new author</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex flex-col">
            <div class="bg-black rounded pt-4 text-white">
                <h2 class="font-bold text-2xl pb-2 px-4 border-b-2 border-b-teal-500">
                    Saved Books <span class="text-sm font-black">({{ $bookTotal }})</span>
                </h2>
                @if($books ?? null)
                    <x-library.book-list :books="$books"/>
                    <div class="px-4 pb-2 pt-3.5 mb-2 border-t-2 border-t-teal-500">
                        <a href="{{ route('library.books') }}" class="btn btn-sm btn-primary !inline">
                            View All Books
                        </a>
                    </div>
                @else
                    <div class="flex flex-col gap-4">
                        <p class="font-bold text-white text-xl">No books added to library yet.</p>
                        <a href="{{ route('search') }}" class="btn btn-lg btn-secondary text-center" role="link"
                           aria-label="Search for a new book">Search for a new book</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex flex-col">
            <div class="bg-black rounded pt-4 text-white">
                <h2 class="font-bold text-2xl pb-2 px-4 border-b-2 border-b-teal-500">Reading List</h2>
                @if($readingList ?? null)
                @else
                    <div class="flex flex-col gap-4 p-4">
                        <p class="font-bold text-white text-xl">Nothing in Reading List</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($authorInfo)
        <div x-data="{ showModal: true }"
             x-on:close-modal.window="$wire.set('authorInfo', null)"
             class="author-modal">
            <x-library.author-modal :authorInfo="$authorInfo"/>
        </div>
    @endif

    @if($bookInfo)
        <div x-data="{ showModal: true }"
             x-on:close-modal.window="$wire.set('bookInfo', null)"
             class="book-modal">
            <x-library.book-modal :book="$bookInfo"/>
        </div>
    @endif
</div>
