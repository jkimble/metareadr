@props(['book', 'savedBooks' => []])
@php
    $bko = $book['key'];
    $book['key'] = str_replace('/works/', '', $book['key']);
@endphp

<div x-data="{ showModal: false }" class="col-span-12 md:col-span-6 lg:col-span-4">
    <article
        class="mb-4 p-4 bg-gray-800 border border-gray-800 h-full text-white rounded hover:border-teal-500 transition">
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
            <x-content.button styling="primary" class="btn-xs" wire:click="saveBook('{{ $bko }}')"
                              :disabled="$savedBooks->contains('key', $book['key'])">
                <x-icons.heart/>
                {{ $savedBooks->contains('key', $book['key']) ? 'Already in Library' : 'Add Book to Library' }}
            </x-content.button>
        </div>
    </article>

    <x-library.book-modal :book="$book" :savedBooks="$savedBooks"/>
</div>
