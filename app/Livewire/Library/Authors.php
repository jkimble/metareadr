<?php

namespace App\Livewire\Library;

use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Authors extends Component
{
    use WithPagination;

    public $authorInfo = null;
    public $currentAuthorId = null;

    public function removeAuthor(Author $author)
    {
        auth()->user()->authors()->detach($author->id);
    }

    public function showAuthorInfo(Author $author)
    {
        $this->authorInfo = $author->toArray();
        $this->currentAuthorId = $author->id;
    }

    public function render()
    {
        $user = Auth::user();
        $authors = $user->authors()->paginate(10);

        return view('livewire.library.authors', [
            'authors' => $authors,
        ]);
    }
}
