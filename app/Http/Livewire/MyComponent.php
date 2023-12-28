<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyComponent extends Component
{
    public $count = 0;

    public function render()
    {
        return view('livewire.my-component');
    }

    public function increment()
    {
        $this->count++;
    }
}
