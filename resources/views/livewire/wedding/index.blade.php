<div>
    <div class="flex justify-end mb-6">
        <x-primary-button wire:click='redirectToCreate'>{{ __('Create Wedding') }}</x-primary-button>
    </div>
    
    <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Wedding Title') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-right">
                        {{ __('Options') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($weddings as $wedding)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('wedding.show', ['wedding_id' => $wedding->id]) }}" class="text-black dark:text-white">
                            {{ $wedding->title }}
                        </a>
                    </th>
                    <td class="flex justify-end gap-3 px-6 py-4 text-right">
                        <a href="{{ route('wedding.edit', ['wedding_id' => $wedding->id]) }}" class="text-amber-500 font-bold">
                            {{ __('Edit') }}
                        </a>
                        <button type="button" wire:click.prevent="delete({{ $wedding->id }})" class="text-red-500 font-bold">
                            {{ __('Delete') }}
                        </button>
                    </td>
                </tr>
                @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td colspan="2" class="h-200 text-center">
                        <p>{{ __('No records found') }}</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
