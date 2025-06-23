<?php

namespace App\Livewire;

use App\Livewire\Forms\searchForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Search extends Component
{
    public $query;
    public $type;
    public $page = 1;
    public $hasMorePages = true;

    public searchForm $search;
    public $results;

    public function mount(): void
    {
        if (Session::has('search_query')) {
            $this->query = Session::get('search_query');
        }

        if (Session::has('search_type')) {
            $this->type = Session::get('search_type');
        }

        $this->search->query = $this->query ?? '';
        $this->search->type = $this->type ?? 'book';

        $this->results = collect();

        if ($this->query) {
            $this->search->validate();
            $this->results = $this->search->librarySearch($this->page);
            $this->hasMorePages = count($this->results) == 9;
        }
    }

    public function loadMore()
    {
        $this->page++;
        $newResults = $this->search->librarySearch($this->page);

        $this->hasMorePages = count($newResults) == 9;

        $this->results = $this->results->merge($newResults);
    }

    public function saveAuthor($authorKey)
    {
        $user = Auth::user();

        if (!$user) {
            $this->dispatch('error', 'You must be logged in to save authors');
            return;
        }

        $savedAuthors = $user->saved_authors ?? [];

        if (!in_array($authorKey, $savedAuthors)) {
            $savedAuthors[] = $authorKey;
            $user->saved_authors = $savedAuthors;
            $user->save();

            $this->dispatch('success', 'Author added to your library');
        } else {
            $this->dispatch('info', 'Author already in your library');
        }
    }

    public function render()
    {
        return view('livewire.search');
    }
}
