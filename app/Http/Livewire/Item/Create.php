<?php

namespace App\Http\Livewire\Item;

use App\Models\Item;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public $title;
    public $value;
    public $budget_id;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'value' => 'integer|min:0|max:999999999'
    ];

    public function submit()
    {
        $this->validate();
        
        Item::create(
            array_merge(
                ['budget_id' => $this->budget_id],
                $this->form->getState()
            )
        );

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send(); 

        $this->emit('closeModal');
    }

    public function cancel()
    {
        $this->emit('closeModal');
    }

    protected function getFormSchema(): array 
    {
        return [
            TextInput::make('title')
                ->required(),
            TextInput::make('value')
                ->required()
                ->numeric(),
        ];
    }

    public function render()
    {
        return view('livewire.item.create');
    }
}
