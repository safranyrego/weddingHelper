<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Budget') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8">
            <section>
                <h1 class="text-3xl text-center text-gray-700 dark:text-gray-300">
                    {{ __('Remaining Budget:') }}
                </h1>
                <p class="text-7xl text-center text-gray-700 dark:text-gray-300">
                    {{-- {{ prettyMoney($this->wedding->remainingBudget) }} --}} 2000000
                </p>
                <div class="mt-7">
                    {{ $this->table }}
                </div>
            </section>
        </div>
    </div>
</div>