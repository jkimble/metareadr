<div>
    <h1>Search for "{{ $query ?? 'undefined' }}"</h1>
    <x-content.container>
        <div class="text-white">
            search results and other things here
        </div>
        @if(count($results))
            <div class="search-results">
                @foreach($results as $result)
                    <div class="result-item mb-4 p-4 bg-gray-800 rounded">
                        <h3 class="text-xl font-bold">{{ $result['title'] ?? 'Untitled' }}</h3>
                        @if(isset($result['author_name']))
                            <p class="text-gray-300">
                                Author: {{ is_array($result['author_name']) ? implode(', ', $result['author_name']) : $result['author_name'] }}</p>
                        @endif
                        @if(isset($result['first_publish_year']))
                            <p class="text-gray-300">Published: {{ $result['first_publish_year'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-results">
                <p>No results found for your search. Please try a different query.</p>
            </div>
        @endif
    </x-content.container>
</div>
