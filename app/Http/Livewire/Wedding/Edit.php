<?php

namespace App\Http\Livewire\Wedding;

use App\Models\Wedding;
use Carbon\Carbon;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class Edit extends Component implements HasForms
{
    use InteractsWithForms;

    public $wedding_id;
    public Wedding $wedding;
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

    public function mount(): void 
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);

        $this->not_sure = $this->wedding->final ? false : true;
        $this->form->fill([
            'title' => $this->wedding->title,
            'planned_from' => $this->wedding->planned_from ? Carbon::parse($this->wedding->planned_from)->format('Y-m-d') : '',
            'planned_to' => $this->wedding->planned_to ? Carbon::parse($this->wedding->planned_to)->format('Y-m-d') : '',
            'final' => $this->wedding->final ? Carbon::parse($this->wedding->final)->format('Y-m-d') : '',
        ]);
    }

    protected function getFormSchema(): array 
    {
        return [
            TextInput::make('title')
                ->label(__('models.wedding.column.title'))
                ->required(),
            TextInput::make('final')
                ->label(__('models.wedding.column.date'))
                ->type('date')
                ->reactive()
                ->visible(!$this->not_sure),
            TextInput::make('planned_from')
                ->label(__('models.wedding.column.planned_from'))
                ->type('date')
                ->reactive()
                ->visible($this->not_sure),
            TextInput::make('planned_to')
                ->label(__('models.wedding.column.planned_to'))
                ->type('date')
                ->reactive()
                ->visible($this->not_sure),
            Toggle::make('not_sure')
                ->label(__('models.wedding.not_sure'))
                ->reactive(),
        ];
    }
    
    public function submit()
    {
        $this->validate();

        $this->wedding->update(
            array_merge(['user_id' => auth()->id()], 
            $this->form->getState())
        );

        Notification::make()
            ->title(__('Saved successfully'))
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
        return view('livewire.wedding.edit');
    }
}
