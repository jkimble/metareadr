<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Form;

class searchForm extends Form
{
    #[Validate('required|string')]
    public string $query;
    #[Validate('required|string')]
    public string $type;
    public string $author;

    public $results = [];

    public function librarySearch($page = 1)
    {
        $url = $this->type === 'author' ? 'https://openlibrary.org/search/authors.json' : 'https://openlibrary.org/search.json';

        $params = ['q' => $this->query, 'limit' => 9];

        if ($this->type === 'book') {
            $params['fields'] = 'title,author_name,author_key,work_count,ratings_count,first_publish_year,subject,first_sentence,isbn,number_of_pages_median,key,cover_i,cover_edition_key';
            $params['page'] = $page;
            $params['lang'] = 'en';
            if ($this->author) $params['author'] = $this->author;
        }

        $response = Http::withHeaders([
            'User-Agent' => 'metareadr (metareadr@mail.metakimb.dev)'
        ])->get($url, $params);

        if ($response->successful()) {
            if ($this->type === 'author') {
                $this->results = collect($response->json('docs'))
                    ->filter(fn($author) => $author['work_count'] >= 2 &&
                        (isset($author['ratings_average']) && $author['ratings_average'] >= 1))
                    ->sortByDesc('ratings_average');
            } else {
                $this->results = collect($response->json('docs'))
                    ->filter(fn($book) => isset($book['ratings_count']) && $book['ratings_count'] >= 2);
            }
        } else {
            $this->results = [];
        }

        return $this->results;
    }
}
