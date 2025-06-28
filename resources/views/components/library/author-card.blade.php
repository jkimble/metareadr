@props(['author', 'savedAuthors' => [], 'authorInfo' => []])

<div x-data="{ showModal: false }"
     x-init="showModal = {{ !empty($authorInfo) ? 'true' : 'false' }}"
     class="flex-auto lg:flex-[0_1_32%]">
    <article
        class="mb-4 p-4 bg-gray-800 border border-gray-800 h-full text-white rounded hover:border-teal-500 transition">
        <h3 class="text-xl font-bold">{{ $author['name'] }}</h3>
        @if(!empty($author['top_work'] ))
            <p class="text-sm font-bold">
                Top Work:
                <span class="italic">{{ $author['top_work'] }}</span>
            </p>
        @endif
        <p class="text-sm">Rating: {{ round($author['ratings_average'], 2) }}</p>
        <div class="flex flex-row flex-nowrap gap-2 mt-4">
            <x-content.button styling="secondary" class="btn-xs" wire:click="getAuthorInfo('{{ $author['key'] }}')"
                              x-on:click="showModal = true">
                <x-icons.book-account/>
                View Author
            </x-content.button>
            <x-content.button styling="primary" class="btn-xs"
                              wire:click="saveAuthor('{{ $author['key'] }}')"
                              :disabled="in_array($author['key'], $savedAuthors)">
                <x-icons.heart/>
                {{ in_array($author['key'], $savedAuthors) ? 'Author in Library' : 'Add Author to Library' }}
            </x-content.button>
        </div>
    </article>

    <x-library.author-modal :authorInfo="$authorInfo"/>
</div>
