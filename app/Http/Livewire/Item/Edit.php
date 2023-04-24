<?php

namespace App\Http\Livewire\Item;

use App\Models\Item;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public Item $item;
    public $title;
    public $value;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'value' => 'integer|min:0|max:999999999'
    ];

    public function mount($item): void
    {
        $this->item = $item;
        $this->form->fill([
            'title' => $this->item->title,
            'value' => $this->item->value,
        ]);
    }

    public function submit()
    {
        $this->validate();
        
        $this->item->update(
            $this->form->getState()
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
                ->reactive()
                ->required(),
            TextInput::make('value')
                ->reactive()
                ->required()
                ->numeric(),
        ];
    }

    public function render()
    {
        return view('livewire.item.edit');
    }
}
