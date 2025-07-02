<?php

namespace App\Livewire;

use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Library extends Component
{

    public function removeAuthor(Author $author)
    {
        auth()->user()->authors()->detach($author->id);
    }

    public function render()
    {
        $user = Auth::user();

        $authors = $user->authors()->take(3)->get();
        $books = $user->books()->take(3)->get();

        return view('livewire.library', [
            'authors' => $authors,
            'books' => $books,
        ]);
    }
}
