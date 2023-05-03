<?php

namespace App\Http\Livewire\Event;

use App\Models\Wedding;
use DateTime;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;

class Index extends Component implements HasTable
{
    use InteractsWithTable;

    public $wedding_id;
    public Wedding $wedding;
    public $events;

    public function mount(): void 
    {
        $this->getEvents();
    }

    public function getEvents()
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);
        $this->events = $this->wedding->events->sortBy('starts_at');
    }

    public function getTableQuery()
    {
        return $this->wedding->eventsQuery();
    }

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('title'),
            TextColumn::make('starts_at'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            EditAction::make()
                ->form([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(40),
                    TimePicker::make('starts_at')
                        ->required()
                        ->withoutSeconds(),
                ])
                ->mutateFormDataUsing(function (array $data): array {
                    $data['wedding_id'] = $this->wedding->id;
                    return $data;
                }),
            DeleteAction::make(),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make('create')
                ->form([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(40),
                    TimePicker::make('starts_at')
                        ->required()
                        ->withoutSeconds(),
                ])
                ->mutateFormDataUsing(function (array $data): array {
                    $data['wedding_id'] = $this->wedding->id;
                    return $data;
                })
                ->after(function() {
                    $this->getEvents();
                })
        ];
    }

    protected function isTablePaginationEnabled(): bool 
    {
        return false;
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
