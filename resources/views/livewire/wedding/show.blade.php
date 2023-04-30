<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $wedding->title }}
    </h2>
</x-slot>

<div class="py-12 space-y-12">
    <div class="sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8">
            <div wire:poll.500ms.keep-alive.visible>
                <div class="flex justify-center gap-7">
                    @if ($this->remaining()->format('%y'))
                        <div class="flex flex-col">
                            <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%y') }}</p>
                            <p class="text-center text-black dark:text-white">{{ __('Year(s)') }}</p>
                        </div>
                    @endif
                    @if ($this->remaining()->format('%m'))
                        <div class="flex flex-col">
                            <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%m') }}</p>
                            <p class="text-center text-black dark:text-white">{{ __('Month(s)') }}</p>
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%d') ? $this->remaining()->format('%D') : '??' }}</p>
                        <p class="text-center text-black dark:text-white">{{ __('Days(s)') }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%h') ? $this->remaining()->format('%H') : '??' }}</p>
                        <p class="text-center text-black dark:text-white">{{ __('Hour(s)') }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%i') ? $this->remaining()->format('%I') : '??' }}</p>
                        <p class="text-center text-black dark:text-white">{{ __('Minute(s)') }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%s') ? $this->remaining()->format('%S') : '??' }}</p>
                        <p class="text-center text-black dark:text-white">{{ __('Second(s)') }}</p>
                    </div>
                </div>
                <div class="text-3xl text-center text-black dark:text-white mt-7">
                    {{ __('Until the BIG day!!! 🥳🍆🍑🎉') }}
                </div>
            </div>
        </div>
    </div>

    <div class="sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                <header>
                    <h2 class="text-3xl font-medium text-gray-900 dark:text-gray-100 mb-3">
                        {{ __('Planning Overview') }}
                    </h2>
                </header>

                <div class="grid grid-cols-4 gap-3">
                    @foreach ($this->wedding->todoStatusGrouped() as $status => $count)
                    <x-filament::stats.card 
                        :label="$count"
                        :description="ucfirst($status)"
                        tag="div"
                        class="filament-stats-overview-widget-card dark:!bg-gray-600 [&_>div>div:first-child]:text-6xl [&_>div>div:last-child]:text-3xl [&_>div>div:last-child]:!text-gray-200 [&_>div>div]:justify-center"
                    />
                    @endforeach
                </div>

                <div class="flex justify-end mt-3">
                    <x-primary-link href="{{ route('todo.index', ['wedding_id' => $this->wedding_id]) }}">
                        {{ __('More') }}
                    </x-primary-button>
                </div>
            </section>
        </div>
    </div>

    <div class="sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                <header>
                    <h2 class="text-3xl font-medium text-gray-900 dark:text-gray-100 mb-3">
                        {{ __('Budget Overview') }}
                    </h2>
                </header>

                <div class="grid grid-cols-2 gap-3">
                    <x-filament::stats.card 
                        label="Budget"
                        :description="prettyMoney($this->wedding->budget->value)"
                        tag="div"
                        class="filament-stats-overview-widget-card dark:!bg-gray-600 [&_>div>div:first-child]:text-3xl [&_>div>div:last-child]:text-6xl [&_>div>div:last-child]:!text-gray-200 [&_>div>div]:justify-center"
                    />
                    <x-filament::stats.card 
                        label="Remaining Budget"
                        :description="prettyMoney($this->wedding->remainingBudget)"
                        tag="div"
                        class="filament-stats-overview-widget-card dark:!bg-gray-600 [&_>div>div:first-child]:text-3xl [&_>div>div:last-child]:text-6xl [&_>div>div:last-child]:!text-gray-200 [&_>div>div]:justify-center"
                    />
                </div>

                <div class="flex justify-end mt-3">
                    <x-primary-link href="{{ route('budget.index', ['wedding_id' => $this->wedding_id]) }}">
                        {{ __('More') }}
                    </x-primary-button>
                </div>
            </section>
        </div>
    </div>

    <div class="sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                <header>
                    <h2 class="text-3xl font-medium text-gray-900 dark:text-gray-100 mb-3">
                        {{ __('Ideas Overview') }}
                    </h2>
                </header>

                <div class="grid grid-cols-4 gap-3">
                    @foreach ($ideas as $idea)
                    <x-idea-preview :idea="$idea" :opensPreview="false"/>
                    @endforeach
                </div>

                <div class="flex justify-end mt-3">
                    <x-primary-link href="{{ route('idea.index', ['wedding_id' => $this->wedding_id]) }}">
                        {{ __('More') }}
                    </x-primary-button>
                </div>
            </section>
        </div>
    </div>
</div>