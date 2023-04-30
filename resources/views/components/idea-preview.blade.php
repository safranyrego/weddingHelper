<div>
    <img
        @if ($opensPreview)
            wire:click="$emit('openModal', 'idea.show', {{ json_encode(['idea' => $idea, 'wedding_id' => $this->wedding_id]) }})"
        @endif
        class="aspect-square object-cover {{ $opensPreview ? 'cursor-pointer' : ''}}"
        src="{{ $idea->urls['small'] }}"
        alt="{{ $idea->alt }}"
    >
</div>