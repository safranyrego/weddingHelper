<?php

namespace App\Http\Livewire\Idea;

use App\Models\Idea;
use LivewireUI\Modal\ModalComponent;

class Show extends ModalComponent
{
    public Idea $idea;

    public function render()
    {
        return view('livewire.idea.show');
    }
}
