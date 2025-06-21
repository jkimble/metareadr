<?php

namespace App\Livewire;

use App\Livewire\Forms\searchForm;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Search extends Component
{
    public $query;
    public $type;

    public searchForm $search;
    public $results = [];

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

        if ($this->query) {
            $this->search->validate();
            $this->results = $this->search->librarySearch();
        }
    }

    public function render()
    {
        return view('livewire.search');
    }
}
