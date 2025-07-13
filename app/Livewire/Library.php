<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Library extends Component
{
    public $authorInfo = null;
    public $bookInfo = null;
    public $currentAuthorId = null;
    public $currentBookId = null;

    public function removeAuthor(Author $author)
    {
        auth()->user()->authors()->detach($author->id);
    }

    public function removeBook(Book $book)
    {
        auth()->user()->books()->detach($book->id);
    }

    public function showAuthorInfo(Author $author)
    {
        $this->authorInfo = $author->toArray();
        $this->currentAuthorId = $author->id;
    }

    public function showBookInfo(Book $book)
    {
        $this->bookInfo = $book->toArray();
        $this->currentBookId = $book->id;
    }

    public function render()
    {
        $user = Auth::user();

        $authors = $user->authors()->take(3)->get();
        $authorTotal = $user->authors()->count();
        $books = $user->books()->take(3)->get();
        $bookTotal = $user->books()->count();

        return view('livewire.library', [
            'authors' => $authors,
            'books' => $books,
            'authorTotal' => $authorTotal,
            'bookTotal' => $bookTotal,
        ]);
    }
}
