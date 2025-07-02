<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Library extends Component
{
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
