<?php

namespace App\Http\Livewire\Wedding;

use App\Models\Wedding;
use Filament\Notifications\Notification;
use Livewire\Component;

class Create extends Component
{
    public string $title = '';

    protected $rules = [
        'title' => 'required|min:3|max:255',
    ];

    public function submit()
    {
        $this->validate();

        Wedding::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
        ]);

        Notification::make() 
            ->title('Saved successfully')
            ->success()
            ->send(); 

        return redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.wedding.create');
    }
}
