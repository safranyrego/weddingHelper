<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Ideas') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8">
            <section>
                <form wire:submit.prevent="search" class="mt-6 space-y-6">
                    <h1 class="text-7xl text-center text-gray-700 dark:text-gray-300">
                        {{ __('Search for ideas! 🧠🐱👌') }}
                    </h1>
                    {{ $this->form }}
                    <div class="flex justify-center gap-4">
                        <x-primary-button>
                            {{ __('Give me those ideas!') }}
                        </x-primary-button>
                    </div>
                </form>
            </section>
        </div>
        @if ($this->favorite)
        <p class="text-4xl text-center text-gray-700 dark:text-gray-300">
            {{ __('Your favorite ideas') }}
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