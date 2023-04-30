<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('The Big Day') }}
    </h2>
</x-slot>

<div>
    @foreach ($this->events as $event)
        <div class="flex justify-center gap-3 [&_div:first-child]:odd:order-last [&_div:last-child]:odd:order-first [&_div:first-child]:odd:justify-start [&_div:last-child]:odd:justify-end">
            <div class="flex-1 flex justify-end my-7">
                <p class="text-white text-4xl font-bold">
                    {{ explode(':', $event->starts_at)[0] }}<sup>{{ explode(':', $event->starts_at)[1] }}</sup>
                </p>
            </div>
            <div class="border-2 border-white"></div>
            <div class="flex-1 flex items-center">
                <p class="text-white text-3xl font-light">
                    {{ $event->title }}
                </p>
            </div>
        </div>
    @endforeach
</div>
