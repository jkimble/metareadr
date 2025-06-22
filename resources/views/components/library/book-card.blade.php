@props(['book'])

<article class="flex-[32%] mb-4 p-4 bg-gray-800 rounded">
    <h3 class="text-xl font-bold">{{ $book['title'] ?? 'Untitled' }}</h3>
    @if(isset($book['author_name']))
        <p class="text-gray-300">
            Author: {{ is_array($book['author_name']) ? implode(', ', $book['author_name']) : $book['author_name'] }}</p>
    @endif
    @if(isset($book['first_publish_year']))
        <p class="text-gray-300">Published: {{ $book['first_publish_year'] }}</p>
    @endif
</article>
