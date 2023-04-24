<?php

namespace App\Http\Livewire\Budget;

use App\Models\Item;
use App\Models\Wedding;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component implements HasTable
{
    use InteractsWithTable;

    public $wedding_id;
    protected Wedding $wedding;

    public function mount(): void 
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);
    }

    protected function getTableQuery(): Builder
    {
        return Item::query();
        // return Item::where('budget_id', $this->budget->id);
        // return $this->wedding->budgetItemsQuery();
    }

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('title')
                ->sortable()
                ->searchable(),
            TextColumn::make('value')
                ->sortable()
                ->searchable(),
        ];
    }
 
    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
                ->color('warning')
                ->icon('heroicon-s-pencil')
                ->action(function (Item $record) {
                    return $this->emit('openModal', 'item.edit', ['item' => $record]);
                }),
            Action::make('delete')
                ->color('danger')
                ->icon('heroicon-s-trash')
                ->requiresConfirmation()
                ->action(fn (Item $record) => $record->delete()),
        ];
    }

    public function render()
    {
        return view('livewire.budget.index');
    }
}
