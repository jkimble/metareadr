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
    public $author;
    public $page = 1;
    public $hasMorePages = true;
    public searchForm $search;
    public $results;
    public $savedAuthors;
    public $savedBooks;

    public function mount(): void
    {
        $this->query = Session::has('search_query') ? Session::get('search_query') : '';
        $this->type = Session::has('search_type') ? Session::get('search_type') : 'book';
        $this->author = Session::has('author') ? Session::get('author') : '';

        $this->search->query = $this->query;
        $this->search->type = $this->type;
        $this->search->author = $this->author;

        $this->results = collect();

        if ($this->query) {
            $this->search->validate();
            $this->results = $this->search->librarySearch($this->page);
            $this->hasMorePages = count($this->results) == 9;
        }

        $this->savedAuthors = Auth::user()->saved_authors ?? [];
        $this->savedBooks = Auth::user()->saved_books ?? [];
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

            $this->dispatch('notify', [
                'message' => 'Author saved!',
                'type' => 'success',
            ]);
        } else {
            $this->dispatch('notify', [
                'message' => 'Author already saved!',
                'type' => 'error',
            ]);
        }
    }

    public function saveBook($bookKey)
    {
        $user = Auth::user();

        if (!$user) {
            $this->dispatch('error', 'You must be logged in to save books');
            return;
        }

        $savedBooks = $user->saved_books ?? [];

        if (!in_array($bookKey, $savedBooks)) {
            $savedBooks[] = $bookKey;
            $user->saved_books = $savedBooks;
            $user->save();

            $this->dispatch('notify', [
                'message' => 'Book saved!',
                'type' => 'success',
            ]);
        } else {
            $this->dispatch('notify', [
                'message' => 'Book already saved!',
                'type' => 'error',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.search');
    }
}
