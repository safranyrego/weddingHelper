<?php

namespace App\Http\Livewire\Todo;

use App\Enums\TodoStatuses;
use App\Models\Todo;
use App\Models\Wedding;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\CreateAction;
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
    use InteractsWithTable;

    public $wedding_id;
    public Wedding $wedding;

    public function mount(): void 
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);
        $this->wedding->checkAccess();
    }

    protected function getTableQuery()
    {
        return $this->wedding->todosQuery()->orderBy('order');
    }

    public function getDefaultSortColumn(): ?string
    {
        return 'order';
    }

    protected function getTableReorderColumn()
    {
        return 'order';
    }

    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make('create')
                ->label(__('models.todo.action.create'))
                ->form([
                    TextInput::make('title')
                        ->label(__('models.todo.column.title'))
                        ->required(),
                    Select::make('status')
                        ->label(__('models.todo.column.status'))
                        ->options(TodoStatuses::selectValues())
                        ->default(TodoStatuses::TODO->value)
                        ->disablePlaceholderSelection()
                ])
                ->modalHeading(__('models.todo.action.create'))
                ->mutateFormDataUsing(function (array $data): array {
                    $data['wedding_id'] = $this->wedding_id;
                    return $data;
                })
        ];
    }

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('title')
                ->label(__('models.todo.column.title'))
                ->sortable()
                ->searchable()
                ->wrap(),
            BadgeColumn::make('status')
                ->label(__('models.todo.column.status'))
                ->colors([
                    'warning' => TodoStatuses::PENDING->value,
                    'success' => TodoStatuses::DONE->value,
                    'danger' => TodoStatuses::FAILED->value,
                ])
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn (string $state): string => __("models.todo.status.$state")),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            EditAction::make()
                ->form([
                    TextInput::make('title')
                        ->required(),
                    Select::make('status')
                        ->options(TodoStatuses::selectValues())
                        ->default(TodoStatuses::TODO->value)
                        ->disablePlaceholderSelection(),
                ])
                ->modalHeading(__('models.todo.action.edit'))
                ->label(false)
                ->size('lg'),
            DeleteAction::make()
                ->modalHeading(__('models.todo.action.delete'))
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
