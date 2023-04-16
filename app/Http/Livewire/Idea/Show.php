<?php

namespace App\Http\Livewire\Idea;

use App\Models\Idea;
use LivewireUI\Modal\ModalComponent;

class Show extends ModalComponent
{
    /**
     * An Idea model as array.
     *
     * @var array
     */
    public array $idea;

    protected static array $maxWidths = [
        '2xl' => 'sm:max-w-500 md:max-w-992 lg:max-w-1440',
    ];

    public function favorite()
    {
        Idea::create([
            'user_id' => auth()->id(),
            'unsplash_id' => $this->idea['unsplash_id'],
            'urls' => $this->idea['urls'],
            'alt' => $this->idea['alt'],
        ]);

        $this->closeModal();
    }

    public function unfavorite()
    {
        $favoriteIdeas = Idea::where([
            'user_id' => auth()->id(),
            'unsplash_id' => $this->idea['unsplash_id'],
        ])->get();

        foreach ($favoriteIdeas as $idea) {
            $idea->delete();
        }

        $this->closeModal();
    }

    public function isFavorite(): bool
    {
        return Idea::where([
            'user_id' => auth()->id(),
            'unsplash_id' => $this->idea['unsplash_id'],
        ])->count();
    }

    public function render()
    {
        return view('livewire.idea.show');
    }
}
