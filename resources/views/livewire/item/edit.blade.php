<div class="p-2 sm:p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="flex justify-between gap-4 mt-6">
            <x-primary-button>
                {{ __('Save') }}
            </x-primary-button>
            <x-secondary-button type="button" wire:click="cancel()">
                {{ __('Cancel') }}
            </x-secondary-button>
        </div>
    </form>
</div>