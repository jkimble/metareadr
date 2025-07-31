<?php

namespace App\Livewire;

use App\Livewire\Forms\searchForm;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
    public $authorInfo;
    public $currentAuthorKey;

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

        $this->savedBooks = Auth::check() ? Auth::user()->books()->get() : collect();
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

            $authorData = $this->results->firstWhere('key', $authorKey);
            if ($authorData) {
                $author = Author::newAuthor($authorData);

                if (!$user->authors()->where('authors.id', $author->id)->exists()) {
                    $user->authors()->attach($author->id);
                }
            }

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

        $bookData = $this->results->firstWhere('key', $bookKey);
        if ($bookData) {
            $book = Book::newBook($bookData);

            if (!$user->books()->where('books.id', $book->id)->exists()) {
                $user->books()->attach($book->id);
                //$this->savedBooks[] = $bookKey;
                // need to fix dispatch messages
//                $this->dispatch('notify', [
//                    'message' => 'Book saved!',
//                    'type' => 'success',
//                ]);
            }
        }
    }

    public function getAuthorInfo($key): void
    {
        $url = "https://openlibrary.org/authors/{$key}.json";
        $response = Http::withHeaders([
            'User-Agent' => 'metareadr (metareadr@mail.metakimb.dev)'
        ])->get($url);

        if ($response->successful()) {
            $this->authorInfo = $response->json();
            $this->currentAuthorKey = $key;
        }
    }

    public function render()
    {
        return view('livewire.search');
    }
}
