<div>
    <div class="w-full flex md:grid md:grid-cols-3 md:auto-rows-min gap-4 px-8 py-4 bg-gray-600">
        <div class="flex flex-col">
            <div class="bg-black rounded pt-4 text-white">
                <h2 class="font-bold text-2xl pb-2 px-4 border-b-2 border-b-teal-500">Saved Authors</h2>
                @if($authors)
                    <ul class="text-white">
                        @foreach($authors as $author)
                            <li class="flex flex-row flex-nowrap items-center gap-2 px-4 py-2 hover:bg-gray-700/50 transition">
                                <h4 class="font-bold text-lg">
                                    {{ $author->name }}
                                </h4>
                                <div class="flex flex-row items-center flex-nowrap gap-1">
                                    {{ round($author->ratings_average, 1) }}
                                    <span class="text-teal-500">
                                        <x-icons.star/>
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
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
            <div class="bg-black rounded p-4 text-white">
                <h2 class="font-bold text-2xl">Saved Books</h2>
                @if($authors)
                    <ul class="text-white">
                        @foreach($books as $book)
                            <li>
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
    </div>
</div>
