@props(['books' => []])

@if($books)
    <ul class="text-white">
        @foreach($books as $book)
            <li class="flex flex-col gap-2 px-4 py-2 hover:bg-gray-700/50 transition">
                <div class="flex flex-row flex-nowrap gap-2">
                    <h4 class="font-bold text-lg">
                        {{ $book->title }}
                    </h4>
                    @if(isset($book->author_names))
                        <div class="text-gray-300">
                            by {{ is_array($book->author_names) ? implode(', ', array_slice($book->author_names, 0, 2)) : $book->author_names }}
                        </div>
                    @endif
                </div>
                <div class="flex flex-row gap-2">
                    <a class="btn btn-xs btn-primary" wire:click="showBookInfo({{ $book->id }})">Info</a>
                    <a class="btn btn-xs btn-danger" wire:confirm="Delete book?"
                       wire:click="removeBook({{ $book->id }})">Remove</a>
                </div>
            </li>
        @endforeach
    </ul>
@endif
