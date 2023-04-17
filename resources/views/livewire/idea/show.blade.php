<div class="p-2 sm:p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <img class="m-auto max-h-custom-picture" src="{{ $idea['urls']['regular'] }}" alt="{{ $idea['alt'] }}">
    <div class="flex justify-between gap-4 pt-4">
        @if ($this->isFavorite())
        <x-primary-button wire:click="unfavorite()">
            {{ __('Unfavorite') }}
        </x-primary-button>
        @else
        <x-primary-button wire:click="favorite()">
            {{ __('Favorite') }}
        </x-primary-button>
        @endif
        
        <x-secondary-button type="button" wire:click="$emit('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>
    </div>
</div>