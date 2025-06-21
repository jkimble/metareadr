<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Search extends Component
{
    public $query;
    public $type;

    public function mount(): void
    {
        if (Session::has('search_query')) {
            $this->query = Session::get('search_query');
            //Session::forget('search_query');
        }

        if (Session::has('search_type')) {
            $this->type = Session::get('search_type');
            //Session::forget('search_type');
        }
    }

    public function render()
    {
        return view('livewire.search');
    }
}
