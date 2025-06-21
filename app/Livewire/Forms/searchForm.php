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

    public $results = [];

    public function librarySearch()
    {
        $url = $this->type === 'author' ? 'https://openlibrary.org/search/authors.json' : 'https://openlibrary.org/search.json';
        $page = request()->input('page', 1);

        $response = Http::get($url, [
            $this->type === 'author' ? 'q' : 'title' => $this->query,
            'limit' => 5,
            'page' => $page,
        ]);

        if ($response->successful()) {
            $this->results = collect($response->json('docs'));
        } else {
            $this->results = [];
        }

        return $this->results;
    }
}
