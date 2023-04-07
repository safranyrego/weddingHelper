<?php

namespace App\Http\Livewire\Wedding;

use App\Models\Wedding;
use DateTime;
use Livewire\Component;

class Show extends Component
{
    public $wedding_id;
    public Wedding $wedding;

    public function mount(): void 
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);
    }

    public function remaining()
    {
        $future_date = new DateTime($this->wedding->final ?? $this->wedding->planned_from);
        return $future_date->diff(now());
    }
    
    public function render()
    {
        return view('livewire.wedding.show');
    }
}
