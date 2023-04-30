<?php

namespace App\Http\Livewire\Idea;

use App\Models\Wedding;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component implements HasForms
{
    use InteractsWithForms;

    public $wedding_id;
    public Wedding $wedding;

    public $search;
    protected array $ideaSearch = [];

    protected $favorite;
    public $favoriteIdeas = [];

    protected $listeners = ['unfavorite'];

    public function unfavorite()
    {
        if (empty($this->search)){
            $this->getFavoriteIdeas();
        } else {
            $this->search();
        }
    }

    public function mount(): void 
    {
        $this->wedding = Wedding::findOrFail($this->wedding_id);
        $this->getFavoriteIdeas();
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
        if (!empty($this->search)) {
            $response = json_decode(file_get_contents('https://api.unsplash.com//search/photos/?query=' . Str::slug($this->search) . '&per_page=20&client_id=zcq8N3EXKZW1fylcZzi_gknCVUP2bVWZPLPCk7bocwQ'));
            if($response->results){
                $this->ideaSearch = $response->results;
                $this->favorite = false;
            }
        } else {
            $this->getFavoriteIdeas();
        }
    }

    public function getFavoriteIdeas()
    {
        $this->favoriteIdeas = $this->wedding->ideas;
        if($this->favoriteIdeas && count($this->favoriteIdeas)){
            $this->favorite = true;
        }
    }

    public function render()
    {
        return view('livewire.idea.index');
    }
}
