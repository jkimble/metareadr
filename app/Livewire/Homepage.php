<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
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
        if (!Auth::user()) {
            $this->redirect(route('login'), navigate: true);
        } else {
            $this->redirect(route('search', ['query' => $this->query, 'type' => $this->type]), navigate: true);;
        }
    }
}
