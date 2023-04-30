<div>
    <div class="flex justify-end mb-6">
        <x-primary-button wire:click='redirectToCreate'>{{ __('Create Wedding') }}</x-primary-button>
    </div>
    
    {{ $this->table }}
</div>
