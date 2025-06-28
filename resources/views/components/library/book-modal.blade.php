@props(['book'])
@php
    $catArray = !empty($book['subject']) ? array_slice($book['subject'], 0, 3) : [];
@endphp
<div x-show="showModal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/70"
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
            <div class="flex flex-row gap-4 mb-4">
                <img src="https://placehold.co/100x150" loading="lazy" alt="placeholder">
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
            <x-content.button styling="secondary" class="btn-xs mt-4" @click="showModal = false">
                Close
            </x-content.button>
        </div>
    </div>
</div>
