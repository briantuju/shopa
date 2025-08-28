<x-filament-panels::page>
    <x-slot name="heading">Choose a Plan</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($packages as $package)
            <x-filament::card>
                <h2 class="text-xl font-semibold">{{ $package->name }}</h2>

                <ul class="flex flex-col gap-2 text-sm bg-gray-100 dark:bg-gray-700 p-4 rounded-lg my-4">
                    @forelse($package->entitlements as $entitlement)
                        <li>
                            <span class="min-w-48 inline-block">{{ $entitlement->key }}</span>
                            @php
                                if(is_array($entitlement->value)){
                                    foreach($entitlement->value as $value){
                                        echo $value.' ';
                                    }
                                } else {
                                    echo $entitlement->value;
                                }
                            @endphp
                        </li>
                    @empty
                    @endforelse
                </ul>

                @if ($package->prices->count() === 1)
                    <p>
                        {{ $package->prices->first()->price }}
                        {{ $package->prices->first()->billing_cycle }}
                        <x-filament::button variant="primary"
                                            wire:click="subscribe({{ $package->prices->first()->id }})">
                            Subscribe
                        </x-filament::button>
                    </p>
                @else
                    <div class="flex flex-col gap-8">
                        @foreach ($package->prices as $price)
                            <p>
                                {{ $price->price }}
                                {{ $price->billing_cycle }}
                                <x-filament::button variant="primary" wire:click="subscribe({{ $price->id }})">
                                    Subscribe
                                </x-filament::button>
                            </p>
                        @endforeach
                    </div>
                @endif
            </x-filament::card>
        @endforeach
    </div>
</x-filament-panels::page>
