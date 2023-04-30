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
    public int $wedding_id;

    protected static array $maxWidths = [
        '2xl' => 'sm:max-w-500 md:max-w-992 lg:max-w-1080',
    ];

    public function favorite()
    {
        Idea::create([
            'wedding_id' => $this->wedding_id,
            'unsplash_id' => $this->idea['unsplash_id'],
            'urls' => $this->idea['urls'],
            'alt' => $this->idea['alt'],
        ]);

        $this->closeModal();
    }

    public function unfavorite()
    {
        $favoriteIdeas = Idea::where([
            'wedding_id' => $this->wedding_id,
            'unsplash_id' => $this->idea['unsplash_id'],
        ])->get();

        foreach ($favoriteIdeas as $idea) {
            $this->emit('unfavorite', $idea);
            $idea->delete();
        }

        $this->closeModal();
    }

    public function isFavorite(): bool
    {
        return Idea::where([
            'wedding_id' => $this->wedding_id,
            'unsplash_id' => $this->idea['unsplash_id'],
        ])->count();
    }

    public function render()
    {
        return view('livewire.idea.show');
    }
}
