<?php

namespace App\View\Components;

use App\Models\Idea;
use Illuminate\View\Component;

class IdeaPreview extends Component
{
    public ?Idea $idea;

    public function __construct(object $idea) {
        $this->idea = Idea::findOr($idea->id, function () use ($idea) {
            return new Idea([
                'unsplash_id' => $idea->id,
                'urls' => $idea->urls,
                'alt' => $idea->alt_description,
            ]);
        });
    } 

    public function render()
    {
        return view('components.idea-preview');
    }
}
