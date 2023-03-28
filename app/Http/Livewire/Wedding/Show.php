<?php

namespace App\Http\Livewire\Wedding;

use App\Models\Wedding;
use Livewire\Component;

class Show extends Component
{
    public $wedding_id;
    public Wedding $wedding;

    public function mount(): void 
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);
    }
    
    public function render()
    {
        return view('livewire.wedding.show');
    }
}
