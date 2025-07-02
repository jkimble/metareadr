<div>
    <div class="w-full flex md:grid md:grid-cols-3 md:auto-rows-min gap-4 px-8 py-4 bg-gray-600">
        <div class="flex flex-col">
            <div class="bg-black rounded pt-4 text-white">
                <h2 class="font-bold text-2xl pb-2 px-4 border-b-2 border-b-teal-500">Saved Authors</h2>
                @if($authors ?? null)
                    <x-library.author-list :authors="$authors"/>
                @else
                    <div class="flex flex-col gap-4">
                        <p class="font-bold text-white text-xl">No authors added to library yet.</p>
                        <a href="{{ route('home') }}" class="btn btn-lg btn-primary text-center" role="link"
                           aria-label="Search for a new author">Search for a new author</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex flex-col">
            <div class="bg-black rounded pt-4 text-white">
                <h2 class="font-bold text-2xl pb-2 px-4 border-b-2 border-b-teal-500">Saved Books</h2>
                @if($books ?? null)
                    <ul class="text-white">
                        @foreach($books as $book)
                            <li class="flex flex-col gap-2 px-4 py-2 hover:bg-gray-700/50 transition">
                                {{ $book->title }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="flex flex-col gap-4">
                        <p class="font-bold text-white text-xl">No books added to library yet.</p>
                        <a href="{{ route('home') }}" class="btn btn-lg btn-secondary text-center" role="link"
                           aria-label="Search for a new author">Search for a new book</a>
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
</div>
