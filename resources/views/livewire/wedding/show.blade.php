<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $wedding->title }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="s lg:px-8m:px-6 space-y-6">
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
                        <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%D') }}</p>
                        <p class="text-center text-black dark:text-white">{{ __('Days(s)') }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%H') }}</p>
                        <p class="text-center text-black dark:text-white">{{ __('Hour(s)') }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%I') }}</p>
                        <p class="text-center text-black dark:text-white">{{ __('Minute(s)') }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-7xl text-center text-black dark:text-white">{{ $this->remaining()->format('%S') }}</p>
                        <p class="text-center text-black dark:text-white">{{ __('Second(s)') }}</p>
                    </div>
                </div>
                <div class="text-3xl text-center text-black dark:text-white mt-7">
                    {{ __('Until the BIG day!!! 🥳🍆🍑🎉') }}
                </div>
            </div>
        </div>
    </div>
</div>