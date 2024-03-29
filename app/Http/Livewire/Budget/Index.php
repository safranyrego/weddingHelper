<?php

namespace App\Http\Livewire\Budget;

use App\Models\Wedding;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component implements HasTable
{
    use InteractsWithTable;

    public $wedding_id;
    public Wedding $wedding;

    public $editBudgetMode = false;
    public $currentBudget;

    protected $listeners = ['closeModal' => '$refresh'];

    public function mount(): void 
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);
        $this->wedding->checkAccess();
        $this->currentBudget = $this->wedding->budget->value;
    }

    public function editBudget()
    {
        $this->wedding->budget->update([
            'value' => $this->currentBudget
        ]);

        $this->toggleEditBudgetMode();
    }

    public function toggleEditBudgetMode()
    {
        $this->editBudgetMode = ! $this->editBudgetMode;
    }

    protected function getTableQuery(): Builder
    {
        return $this->wedding->budgetItemsQuery();
    }

    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make('create')
                ->label(__('models.item.action.create'))
                ->form([
                    TextInput::make('title')
                        ->label(__('models.item.column.title'))
                        ->required(),
                    TextInput::make('value')
                        ->label(__('models.item.column.value'))
                        ->required()
                        ->integer()
                        ->minValue(0),
                ])
                ->modalHeading(__('models.item.action.create'))
                ->mutateFormDataUsing(function (array $data): array {
                    $data['budget_id'] = $this->wedding->budget->id;
                    return $data;
                })
        ];
    }

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('title')
                ->label(__('models.item.column.title'))
                ->sortable()
                ->searchable(),
            TextColumn::make('value')
                ->label(__('models.item.column.value'))
                ->sortable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            EditAction::make()
                ->modalHeading(__('models.item.action.edit'))
                ->form([
                    TextInput::make('title')
                        ->label(__('models.item.column.title'))
                        ->required(),
                    TextInput::make('value')
                        ->label(__('models.item.column.value'))
                        ->required()
                        ->integer()
                        ->minValue(0),
                ]),
            DeleteAction::make()
                ->modalHeading(__('models.item.action.delete')),
        ];
    }

    public function render()
    {
        return view('livewire.budget.index');
    }
}
