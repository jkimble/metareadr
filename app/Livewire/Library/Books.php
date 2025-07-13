<?php

namespace App\Livewire\Library;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{
    use WithPagination;

    public $bookInfo = null;
    public $currentBookId = null;

    public function removeBook(Book $book)
    {
        auth()->user()->books()->detach($book->id);
    }

    public function showBookInfo(Book $book)
    {
        $this->bookInfo = $book->toArray();
        $this->currentBookId = $book->id;
    }

    public function render()
    {
        $user = Auth::user();
        $books = $user->books()->paginate(10);

        return view('livewire.library.books', [
            'books' => $books,
        ]);
    }
}
