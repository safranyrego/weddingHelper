<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('navigation.ideas') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8">
            <section>
                <form wire:submit.prevent="search" class="mt-6 space-y-6">
                    <h1 class="text-7xl text-center text-gray-700 dark:text-gray-300">
                        {{ __('models.idea.heading') }}
                    </h1>
                    {{ $this->form }}
                    <div class="flex justify-center gap-4">
                        <x-primary-button>
                            {{ __('models.idea.button') }}
                        </x-primary-button>
                        @if(!$this->favorite && (count($this->favoriteIdeas) || count($this->ideaSearch)))
                        <x-primary-button wire:click.prevent="getFavoriteIdeas">
                            {{ __('Back') }}
                        </x-primary-button>
                        @endif
                    </div>
                </form>
            </section>
        </div>
        @if ($this->favorite)
        <p class="text-4xl text-center text-gray-700 dark:text-gray-300 mb-3">
            {{ __('models.idea.favorite') }}
        </p>
        <div class="grid grid-cols-4 gap-1.5">
            @foreach ($this->favoriteIdeas as $idea)
            <x-idea-preview :idea="$idea"/>
            @endforeach
        </div>
        @else
        <div class="grid grid-cols-4 gap-1.5">
            @foreach ($this->ideaSearch as $idea)
            <x-idea-preview :idea="$idea"/>
            @endforeach
        </div>
        @endif
    </div>
</div>