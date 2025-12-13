<?php

namespace App\Livewire;

use Livewire\Component;

class NotFound extends Component
{
    public $message = 'The page you are looking for was not found.';

    public function render()
    {
        return view('welcome');
    }
}
