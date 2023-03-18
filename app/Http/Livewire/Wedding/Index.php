<?php

namespace App\Http\Livewire\Wedding;

use App\Models\Wedding;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Livewire\Component;

class Index extends Component
{
    public $weddings;

    protected $listeners = ['undoDelete'];

    public function redirectToCreate()
    {
        return redirect()->to(route('wedding.create'));
    }

    public function mount()
    {
        $this->weddings = auth()->user()->weddings;
    }

    public function delete($id)
    {
        $wedding = Wedding::findOrFail($id);

        $wedding->delete();

        Notification::make() 
            ->title('Deleted successfully')
            ->success()
            ->actions([
                Action::make('undo')
                    ->button()
                    ->color('secondary')
                    ->emit('undoDelete', [$wedding->id])
                    ->close(),
            ])
            ->send(); 

        return redirect(route('dashboard'));
    }

    public function undoDelete($id)
    {
        $wedding = Wedding::withTrashed()->findOrFail($id);

        $wedding->restore();

        Notification::make() 
            ->title('Restored successfully')
            ->success()
            ->send();

        return redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.wedding.index');
    }
}
