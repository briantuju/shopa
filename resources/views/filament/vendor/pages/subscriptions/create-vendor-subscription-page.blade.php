<x-filament-panels::page>
    <x-slot name="heading">Choose a Plan</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
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

                <livewire:plan-selector
                    {{-- Listen to the subscribe event --}}
                    @subscribe="subscribe($event.detail.priceId)"
                    :prices="$package->prices->map(fn($p) => [
                            'id' => $p->id,
                            'billing_cycle' => $p->billing_cycle,
                            'price' => $p->price,
                            'description' => $p->description ?? '',
                        ])->toArray()"
                    :key="$package->id"
                />
            </x-filament::card>
        @endforeach
    </div>
</x-filament-panels::page>
