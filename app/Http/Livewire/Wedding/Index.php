<?php

namespace App\Http\Livewire\Wedding;

use App\Models\Wedding;
use Closure;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
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

    protected $listeners = ['undoDelete'];

    public function redirectToCreate()
    {
        return redirect()->to(route('wedding.create'));
    }

    public function getTableQuery()
    {
        return auth()->user()->weddingsQuery();
    }

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('title')
                ->sortable(),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make('create')
                ->label(__('Create Wedding'))
                ->url(route('wedding.create'))
        ];
    }

    protected function getTableActions(): array
    {
        return [
            EditAction::make()
                ->url(fn (Wedding $record): string => route('wedding.edit', $record)),
            DeleteAction::make(),
        ];
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn (Wedding $record): string => route('wedding.show', $record);
    }

    public function delete($id)
    {
        $wedding = Wedding::findOrFail($id);

        $wedding->delete();

        Notification::make() 
            ->title('Deleted successfully')
            ->success()
            ->actions([
                Action::make('undo')
                    ->button()
                    ->color('secondary')
                    ->emit('undoDelete', [$wedding->id])
                    ->close(),
            ])
            ->send(); 

        return redirect(route('dashboard'));
    }

    public function undoDelete($id)
    {
        $wedding = Wedding::withTrashed()->findOrFail($id);

        $wedding->restore();

        Notification::make() 
            ->title('Restored successfully')
            ->success()
            ->send();

        return redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.wedding.index');
    }
}
