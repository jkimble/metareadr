@props(['book'])

<article
    class="flex-[0_1_32%] mb-4 p-4 bg-gray-800 border border-gray-800 text-white rounded hover:border-teal-500 transition">
    <h3 class="text-xl font-bold">{{ $book['title'] ?? 'Untitled' }}</h3>
    @if(isset($book['author_name']))
        <p class="text-gray-300">
            Author: {{ is_array($book['author_name']) ? implode(', ', $book['author_name']) : $book['author_name'] }}</p>
    @endif
    @if(isset($book['first_publish_year']))
        <p class="text-gray-300">Published: {{ $book['first_publish_year'] }}</p>
    @endif
    <div class="flex flex-row flex-nowrap gap-2 mt-4">
        <x-content.button styling="secondary" class="btn-xs">
            <x-icons.book/>
            More Details
        </x-content.button>
        <x-content.button styling="primary" class="btn-xs" wire:click="saveBook('{{ $book['key'] }}')">
            <x-icons.heart/>
            Add Book to Library
        </x-content.button>
    </div>
</article>
