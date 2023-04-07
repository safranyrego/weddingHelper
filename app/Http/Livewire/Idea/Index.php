<?php

namespace App\Http\Livewire\Idea;

use App\Models\Wedding;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Index extends Component implements HasForms
{
    use InteractsWithForms;
    
    public $wedding_id;
    public Wedding $wedding;

    public array $ideaSearch = [];

    public $search;

    public function mount(): void 
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);
    }

    protected function getFormSchema(): array 
    {
        return [
            TextInput::make('search')
                ->label(false)
                ->extraInputAttributes(['class'=>'text-center']),
        ];
    }

    public function search()
    {
        $response = json_decode(file_get_contents('https://api.unsplash.com//search/photos/?query=' . $this->search . '&per_page=20&client_id=zcq8N3EXKZW1fylcZzi_gknCVUP2bVWZPLPCk7bocwQ'));
        if($response->results){
            $this->ideaSearch = $response->results;
        }
    }

    public function render()
    {
        return view('livewire.idea.index');
    }
}
