@props(['book', 'savedBooks' => []])

<div x-data="{ showModal: false }" class="flex-[0_1_32%] ">
    <article
        class="mb-4 p-4 bg-gray-800 border border-gray-800 text-white rounded hover:border-teal-500 transition">
        <h3 class="text-xl font-bold">{{ $book['title'] ?? 'Untitled' }}</h3>
        @if(isset($book['author_name']))
            <p class="text-gray-300">
                Author: {{ is_array($book['author_name']) ? implode(', ', array_slice($book['author_name'], 0, 3)) : $book['author_name'] }}</p>
        @endif
        @if(isset($book['first_publish_year']))
            <p class="text-gray-300">Published: {{ $book['first_publish_year'] }}</p>
        @endif
        <div class="flex flex-row flex-nowrap gap-2 mt-4">
            <x-content.button styling="secondary" class="btn-xs" @click="showModal = true">
                <x-icons.book/>
                More Details
            </x-content.button>
            <x-content.button styling="primary" class="btn-xs" wire:click="saveBook('{{ $book['key'] }}')"
                              :disabled="in_array($book['key'], $savedBooks)">
                <x-icons.heart/>
                {{ in_array($book['key'], $savedBooks) ? 'Already in Library' : 'Add Book to Library' }}
            </x-content.button>
        </div>
    </article>

    <div x-show="showModal"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/70"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-white">{{ $book['title'] ?? 'Untitled' }}</h3>
                <button @click="showModal = false" class="text-gray-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mt-4 flex justify-end">
                <x-content.button styling="secondary" class="btn-xs" @click="showModal = false">
                    Close
                </x-content.button>
            </div>
        </div>
    </div>
</div>
