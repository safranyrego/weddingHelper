<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Budget') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8">
            <section>
                <div class="flex">
                    @if (!$this->editBudgetMode)
                    <div class="flex-1">
                        <h1 class="text-3xl text-center text-gray-700 dark:text-gray-300">
                            {{ __('Budget:') }}
                        </h1>
                        <p class="text-6xl text-center text-gray-700 dark:text-gray-300" wire:click="toggleEditBudgetMode">
                            {{ prettyMoney($this->currentBudget) }}
                        </p>
                    </div>
                    @else
                    <div class="flex-1 flex items-end justify-center">
                        <form wire:submit.prevent="editBudget" class="flex content-center">
                            <x-text-input type="number" wire:model="currentBudget" class="text-4xl text-center text-gray-700 dark:text-gray-300 appearance-none m-0" />
                            <div class="flex">
                                <x-primary-button class="ml-3">
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="flex-1">
                        <h1 class="text-3xl text-center text-gray-700 dark:text-gray-300">
                            {{ __('Remaining Budget:') }}
                        </h1>
                        <p class="text-6xl text-center text-gray-700 dark:text-gray-300">
                            {{ prettyMoney($this->wedding->remainingBudget) }}
                        </p>
                    </div>
                </div>
                <div class="mt-7">
                    {{ $this->table }}
                </div>
            </section>
        </div>
    </div>
</div>