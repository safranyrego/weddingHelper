<?php

namespace App\Http\Livewire\Budget;

use App\Models\Wedding;
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
        return $this->wedding->budgetItemsQuery();
    }

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('title'),
            TextColumn::make('value'),
        ];
    }
 
    protected function getTableFilters(): array
    {
        return [];
    }
 
    protected function getTableActions(): array
    {
        return [];
    }
 
    protected function getTableBulkActions(): array
    {
        return [];
    }

    public function render()
    {
        return view('livewire.budget.index');
    }
}
