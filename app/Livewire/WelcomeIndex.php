<?php

namespace App\Livewire;

use App\Models\Travel;
use Livewire\Component;

class WelcomeIndex extends Component
{
    public $travels;
    public function render()
    {
        $this->travels = Travel::all();
        return view('livewire.welcome-index')->layout('welcome');
    }
}
