<?php

namespace App\Livewire;

use Livewire\Component;

class Search extends Component
{
    public $query;
    public $type;

    public function mount(): void
    {

    }

    public function render()
    {
        return view('livewire.search');
    }
}
