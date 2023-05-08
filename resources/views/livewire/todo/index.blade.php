<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('models.todo.bigtitle') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8">
            <section>
                <div class="mt-7">
                    {{ $this->table }}
                </div>
            </section>
        </div>
    </div>
</div>