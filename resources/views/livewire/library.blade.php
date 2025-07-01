<div>
    <div class="w-full flex flex-row gap-6 bg-gray-600">
        <div class="flex flex-col">
            <div class="bg-black rounded p-4 text-white">
                <h2 class="font-bold text-2xl">Saved Authors</h2>
                @if($authors)
                    <ul class="text-white">
                        @foreach($authors as $author)
                            <li>
                                {{ $author->name }}
                                {{ round($author->ratings_average, 2) }}
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
