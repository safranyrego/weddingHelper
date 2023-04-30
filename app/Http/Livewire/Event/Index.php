<?php

namespace App\Http\Livewire\Event;

use App\Models\Wedding;
use DateTime;
use Livewire\Component;

class Index extends Component
{
    public $wedding_id;
    public Wedding $wedding;

    public $events;

    public function mount(): void 
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);
        $this->events = $this->wedding->events->sortBy('starts_at');
    }

    public function format(string $starts_at)
    {
        $date = new DateTime($starts_at);
    }

    public function render()
    {
        return view('livewire.event.index');
    }
}
