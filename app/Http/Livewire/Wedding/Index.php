<?php

namespace App\Http\Livewire\Wedding;

use Livewire\Component;

class Index extends Component
{
    public $weddings;

    public function redirectToCreate()
    {
        return redirect()->to(route('wedding.create'));
    }

    public function mount()
    {
        $this->weddings = $this->getLoggedinUserWeddings();
        // $this->weddings = auth()->user()->weddings;
    }

    public function render()
    {
        return view('livewire.wedding.index');
    }

    private function getLoggedinUserWeddings()
    {
        return auth()->user()->weddings;
    }
}
