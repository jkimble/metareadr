<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
    public function render(): object
    {
        return view('livewire.homepage');
    }

    public function submit(): void
    {
        $this->validate();

        Session::put('search_query', $this->query);
        Session::put('search_type', $this->type);

        if (!Auth::user()) {
            Session::put('url.intended', route('search'));
            $this->redirect(route('login'));
        } else {
            $this->redirect(route('search'), navigate: true);;
        }
    }
}
