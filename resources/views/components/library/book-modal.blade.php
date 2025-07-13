@props(['book', 'savedBooks' => []])
@php
    $isDbBook = isset($book['author_names']) && !isset($book['author_name']);
    $coverId = $isDbBook ? $book['cover_i'] : ($book['cover_i'] ?? null);
    $title = $isDbBook ? $book['title'] : ($book['title'] ?? 'Untitled');
    $authorName = $isDbBook ?
        (is_array($book['author_names']) ? implode(', ', array_slice($book['author_names'], 0, 2)) : $book['author_names']) :
        (isset($book['author_name']) && is_array($book['author_name']) ? $book['author_name'][0] : '');
    $publishYear = $isDbBook ? $book['first_publish_year'] : ($book['first_publish_year'] ?? '');
    $catArray = $isDbBook ?
        (isset($book['subjects']) && is_array($book['subjects']) ? array_slice($book['subjects'], 0, 3) : []) :
        (!empty($book['subject']) ? array_slice($book['subject'], 0, 3) : []);
    $firstSentence = $isDbBook ?
        $book['first_sentence'] :
        (isset($book['first_sentence']) && is_array($book['first_sentence']) ? $book['first_sentence'][0] ?? '' : '');
    $key = $isDbBook ? $book['key'] : ($book['key'] ?? '');
@endphp
<div x-show="showModal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 px-4"
     @click="showModal = false; $dispatch('close-modal')"
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
                @if($coverId)
                    <img src="https://covers.openlibrary.org/b/id/{{$coverId}}-M.jpg"
                         alt="{{ $title }} Cover" width="150"
                         class="max-h-[150px]" loading="lazy">
                @endif
                <div class="flex-col gap-2 text-white">
                    <h3 class="text-xl font-bold text-white">{{ $title }}</h3>
                    @if($authorName)
                        <p class="italic">{{ $authorName }}</p>
                    @endif
                    @if($publishYear)
                        <p>Published: {{ $publishYear }}</p>
                    @endif
                    @if(!empty($catArray))
                        @foreach($catArray as $cat)
                            {{ $loop->last ? $cat : $cat . ',' }}
                        @endforeach
                    @endif
                </div>
            </div>
            <button @click="showModal = false; $dispatch('close-modal')"
                    class="text-gray-400 hover:text-white hover:cursor-pointer">
                <x-icons.close/>
            </button>
        </div>
        <div class="flex flex-col gap-2 text-white mt-4">
            @if($firstSentence)
                <h2 class="font-black">Excerpts:</h2>
                <p class="italic border-l-4 border-gray-700 pl-4">{{ $firstSentence }}</p>
            @endif
            <div class="flex flex-row flex-nowrap items-center justify-between gap-2 mt-4">
                @if($key)
                    <x-content.button styling="primary" class="btn-xs" wire:click="saveBook('{{ $key }}')"
                                      :disabled="in_array($key, $savedBooks)">
                        <x-icons.heart/>
                        {{ in_array($key, $savedBooks) ? 'Already in Library' : 'Add Book to Library' }}
                    </x-content.button>
                @endif
                <x-content.button styling="secondary" class="btn-xs"
                                  @click="showModal = false; $dispatch('close-modal')">
                    <x-icons.close/>
                    Close
                </x-content.button>
            </div>
        </div>
    </div>
</div>
