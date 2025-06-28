@props(['book', 'savedBooks' => []])
@php
    $catArray = !empty($book['subject']) ? array_slice($book['subject'], 0, 3) : [];
@endphp
<div x-show="showModal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 px-4"
     @click="showModal = false"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display: none;">
    <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full">
        <div class="flex flex-row flex-nowrap items-start justify-between">
            <div class="flex flex-col sm:flex-row gap-4 mb-4">
                <img src="https://covers.openlibrary.org/b/id/{{$book['cover_i']}}-M.jpg"
                     alt="{{ $book['title'] }} Cover" width="150"
                     class="max-h-[150px]" loading="lazy">
                <div class="flex-col gap-2 text-white">
                    <h3 class="text-xl font-bold text-white">{{ $book['title'] ?? 'Untitled' }}</h3>
                    <p class="italic">{{ $book['author_name'][0] }}</p>
                    <p>Published: {{ $book['first_publish_year'] }}</p>
                    @if(!empty($catArray))
                        @foreach($catArray as $cat)
                            {{ $loop->last ? $cat : $cat . ',' }}
                        @endforeach
                    @endif
                </div>
            </div>
            <button @click="showModal = false" class="text-gray-400 hover:text-white hover:cursor-pointer">
                <x-icons.close/>
            </button>
        </div>
        <div class="flex flex-col gap-2 text-white mt-4">
            @if(!empty($book['first_sentence']))
                <h2 class="font-black">Excerpts:</h2>
                <p class="italic border-l-4 border-gray-700 pl-4">{{ $book['first_sentence'][0] ?? '' }}</p>
            @endif
            <div class="flex flex-row flex-nowrap items-center justify-between gap-2 mt-4">
                <x-content.button styling="primary" class="btn-xs" wire:click="saveBook('{{ $book['key'] }}')"
                                  :disabled="in_array($book['key'], $savedBooks)">
                    <x-icons.heart/>
                    {{ in_array($book['key'], $savedBooks) ? 'Already in Library' : 'Add Book to Library' }}
                </x-content.button>
                <x-content.button styling="secondary" class="btn-xs" @click="showModal = false">
                    <x-icons.close/>
                    Close
                </x-content.button>
            </div>
        </div>
    </div>
</div>
