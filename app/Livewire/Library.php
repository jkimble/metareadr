<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Library extends Component
{
    use WithPagination;

    public function render()
    {
        $user = Auth::user();

        $authors = $user->authors()->paginate(10);
        //$authors = $user->authors()->get();
        $books = $user->books()->paginate(10);

        return view('livewire.library', [
            'authors' => $authors,
            'books' => $books,
        ]);
    }
}
