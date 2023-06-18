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
        $this->wedding->checkAccess();
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
            $response = json_decode(file_get_contents('https://api.unsplash.com//search/photos/?query=' . Str::slug($this->translateSearch($this->search)) . '&per_page=20&client_id='. config('unsplash.client_id'))); 
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
        $this->search = "";
        $this->favoriteIdeas = $this->wedding->ideas;
        if($this->favoriteIdeas && count($this->favoriteIdeas)){
            $this->favorite = true;
        }
    }

    public function translateSearch($search) {
        $language = 'en';
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2/detect",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "q=" . urlencode($search),
            CURLOPT_HTTPHEADER => [
                "Accept-Encoding: application/gzip",
                "X-RapidAPI-Host: google-translate1.p.rapidapi.com",
                "X-RapidAPI-Key: " . config('rapid_api.key'),
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if (!$err) {
            $response = json_decode($response);
            if (property_exists($response, 'data')) {
                $language = $response->data->detections[0][0]->language;
            }
        }

        if ($language != 'en'){
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "q=" . urlencode($search) . "&target=en&source=" . $language,
                CURLOPT_HTTPHEADER => [
                    "Accept-Encoding: application/gzip",
                    "X-RapidAPI-Host: google-translate1.p.rapidapi.com",
                    "X-RapidAPI-Key: " . config('rapid_api.key'),
                    "content-type: application/x-www-form-urlencoded"
                ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if (!$err) {
                $response = json_decode($response);
                $search = $response->data->translations[0]->translatedText;
            }
        }

        return $search;
    }

    public function render()
    {
        return view('livewire.idea.index');
    }
}
