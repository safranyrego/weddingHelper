<?php

namespace App\Http\Livewire\Wedding;

use App\Models\Budget;
use App\Models\Todo;
use App\Models\Wedding;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public string $title = '';
    public string $planned_from = '';
    public string $planned_to = '';
    public string $final = '';
    public bool $not_sure = false;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'planned_from' => 'date',
        'planned_to' => 'date',
        'final' => 'date',
    ];

    protected function getFormSchema(): array 
    {
        return [
            TextInput::make('title')
                ->required(),
            TextInput::make('final')
                ->label('Date')
                ->type('date')
                ->reactive()
                ->visible(!$this->not_sure),
            TextInput::make('planned_from')
                ->type('date')
                ->reactive()
                ->visible($this->not_sure),
            TextInput::make('planned_to')
                ->type('date')
                ->reactive()
                ->visible($this->not_sure),
            Toggle::make('not_sure')
                ->label('Not sure about the exact date.')
                ->reactive(),
        ];
    }

    public function submit()
    {
        $this->validate();

        $wedding = Wedding::create(
            array_merge(['user_id' => auth()->id()], 
            $this->form->getState())
        );

        Todo::createTodoListForNewWedding($wedding->id);
        Budget::create([
            'wedding_id' => $wedding->id,
            'value' => 0,
        ]);

        Notification::make() 
            ->title('Saved successfully')
            ->success()
            ->send(); 

        return redirect(route('dashboard'));
    }

    public function cancel()
    {
        return redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.wedding.create');
    }
}
