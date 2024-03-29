<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('models.wedding.action.edit', ['title' => $this->wedding->title]) }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('models.wedding.heading') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("models.wedding.subheading") }}
                    </p>
                </header>

                <form wire:submit.prevent="submit" class="mt-6 space-y-6">
                    {{ $this->form }}

                    <div class="flex justify-between gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        <x-secondary-button type="button" wire:click="cancel()">{{ __('Cancel') }}</x-secondary-button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>