<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Homepage extends Component
{
    #[Validate('required|string')]
    public $query;
    #[Validate('required')]
    public $type;

    #[Title('metareadr')]
    public function render()
    {
        return view('livewire.homepage');
    }

    public function submit()
    {
        $this->validate();
        dd('submitted');
    }
}
