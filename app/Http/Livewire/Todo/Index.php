<?php

namespace App\Http\Livewire\Todo;

use App\Enums\TodoStatuses;
use App\Models\Todo;
use Filament\Forms\Components\Concerns\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\CreateAction;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component implements HasTable
{
    use InteractsWithTable, HasActions;

    protected function getActions(): array
    {
        dd('here');
        return [
            CreateAction::make()
        ];
    }

    protected function getTableQuery()
    {
        return Todo::query()->orderBy('order');
    }

    public function getDefaultSortColumn(): ?string
    {
        return 'order';
    }

    protected function getTableReorderColumn()
    {
        return 'order';
    }

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('title')
                ->sortable()
                ->searchable()
                ->wrap(),
            BadgeColumn::make('status')
                ->colors([
                    'warning' => TodoStatuses::PENDING->value,
                    'success' => TodoStatuses::DONE->value,
                    'danger' => TodoStatuses::FAILED->value,
                ])
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn (string $state): string => ucfirst($state)),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            EditAction::make()
                ->form([
                    TextInput::make('title')->required(),
                    Select::make('status')
                        ->options(TodoStatuses::selectValues())
                        ->default(TodoStatuses::TODO->value)
                        ->disablePlaceholderSelection(),
                ])
                ->label(false)
                ->size('lg'),
            DeleteAction::make()
                ->label(false)
                ->size('lg'),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('todo')
                ->action(fn (Collection $records) => $records->each->setStatus(TodoStatuses::TODO))
                ->requiresConfirmation()
                ->color('secondary')
                ->deselectRecordsAfterCompletion(),
            BulkAction::make('pending')
                ->action(fn (Collection $records) => $records->each->setStatus(TodoStatuses::PENDING))
                ->requiresConfirmation()
                ->color('warning')
                ->deselectRecordsAfterCompletion(),
            BulkAction::make('done')
                ->action(fn (Collection $records) => $records->each->setStatus(TodoStatuses::DONE))
                ->requiresConfirmation()
                ->color('success')
                ->deselectRecordsAfterCompletion(),
            BulkAction::make('failed')
                ->action(fn (Collection $records) => $records->each->setStatus(TodoStatuses::FAILED))
                ->requiresConfirmation()
                ->color('danger')
                ->deselectRecordsAfterCompletion(),
        ];
    }

    public function render()
    {
        return view('livewire.todo.index');
    }
}
