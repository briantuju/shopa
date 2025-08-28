<div x-data="{ selected: @entangle('selected') }">
    <ul class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        @foreach ($prices as $price)
            <li
                wire:click="select({{ $price['id'] }})"
                class="cursor-pointer rounded-2xl border p-4 transition hover:bg-gray-200
                {{ $selected === $price['id']
                    ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20'
                    : 'border-gray-300 dark:border-gray-700' }}">

                <div class="flex flex-col gap-2">
                    <span class="font-semibold text-lg">
                        {{ ucfirst($price['billing_cycle']->value) }}
                    </span>

                    <span class="text-blue-600 font-bold text-xl">
                        $ {{ $price['price'] }}
                    </span>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $price['description'] ? $price['description'] : 'This plan renews ' . $price['billing_cycle']->value }}
                    </p>
                </div>
            </li>
        @endforeach
    </ul>

    <div x-show="!selected" class="mt-4">
        To subscribe, select a plan.
    </div>

    <div class="mt-4">
        <x-filament::button
            variant="primary"
            wire:click="continue"
            wire:show="selected"
        >
            Continue
        </x-filament::button>
    </div>

</div>
