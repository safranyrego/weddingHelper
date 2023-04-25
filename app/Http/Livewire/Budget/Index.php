<?php

namespace App\Http\Livewire\Budget;

use App\Models\Item;
use App\Models\Wedding;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Concerns\UsesResourceForm;
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

    protected $listeners = ['closeModal' => '$refresh'];

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
            EditAction::make()
                ->form([
                    TextInput::make('title')->required(),
                    TextInput::make('value')->required(),
                ]),
            DeleteAction::make(),
        ];
    }

    public function render()
    {
        return view('livewire.budget.index');
    }
}
