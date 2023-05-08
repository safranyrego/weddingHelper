<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('navigation.the_big_day') }}
    </h2>
</x-slot>

<div>
    @foreach ($this->events as $event)
        <div class="flex justify-center gap-3 group/event-row [&_div:first-child]:odd:order-3 [&_div:last-child]:odd:order-1 [&_div:first-child]:odd:justify-start [&_div:last-child]:odd:justify-end">
            <div class="flex-1 flex justify-end my-7 order-1">
                <p class="dark:text-white text-4xl font-bold">
                    {{ explode(':', $event->starts_at)[0] }}<sup>{{ explode(':', $event->starts_at)[1] }}</sup>
                </p>
            </div>
            <div class="order-first flex items-center">
                <x-secondary-button class="invisible group-hover/event-row:visible" wire:click="mountTableAction('edit', {{ $event->id }})">
                    {{ __('Edit') }}
                </x-secondary-button>
            </div>
            <div class="border-2 border-black dark:border-white order-2"></div>
            <div class="order-last flex items-center">
                <x-danger-button class="invisible group-hover/event-row:visible" wire:click="mountTableAction('delete', {{ $event->id }})">
                    {{ __('Delete') }}
                </x-danger-button>
                
            </div>
            <div class="flex-1 flex items-center order-3">
                <p class="dark:text-white text-3xl font-light break-all">
                    {{ $event->title }}
                </p>
            </div>
        </div>
    @endforeach
    <div class="flex justify-center mt-3">
        <x-primary-button wire:click="mountTableAction('create')">
            {{ __('models.event.action.create') }}
        </x-primary-button>
    </div>
    <div class="!h-0 !w-0 [&>div>div]:!h-0 [&>div>div>div>div>div>div>div>button]:hidden">
        {{ $this->table }}
    </div>
</div>
