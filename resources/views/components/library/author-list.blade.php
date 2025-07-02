@props(['authors' => []])

@if($authors)
    <ul class="text-white">
        @foreach($authors as $author)
            <li class="flex flex-col gap-2 px-4 py-2 hover:bg-gray-700/50 transition">
                <div class="flex flex-row flex-nowrap gap-2">
                    <h4 class="font-bold text-lg">
                        {{ $author->name }}
                    </h4>
                    <div class="flex flex-row items-center flex-nowrap gap-1">
                        {{ round($author->ratings_average, 1) }}
                        <span class="text-teal-500">
                        <x-icons.star/>
                    </span>
                    </div>
                </div>
                <div class="flex flex-row gap-2">
                    <a class="btn btn-xs btn-primary">Info</a>
                    <a class="btn btn-xs btn-secondary">Works</a>
                    <a class="btn btn-xs btn-danger" wire:confirm="Delete author?"
                       wire:click="removeAuthor({{ $author->id }})">Remove</a>
                </div>
            </li>
        @endforeach
    </ul>
@endif
