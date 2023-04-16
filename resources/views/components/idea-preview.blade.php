<div>
    <img
        wire:click="$emit('openModal', 'idea.show', {{ json_encode(['idea' => $idea]) }})"
        class="aspect-square object-cover cursor-pointer"
        src="{{ $idea->urls['small'] }}"
        alt="{{ $idea->alt }}"
    >
</div>