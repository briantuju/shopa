<x-filament-panels::page>
    @if ($subscription)
        <div class="space-y-4">
            <x-filament::card>
                <h2 class="text-xl font-semibold">Current Plan: {{ $subscription->package->name }}</h2>
                <div class="text-sm text-gray-400">
                    <p>Started: {{ $subscription->started_at }}</p>
                    <p>Expires: {{ $subscription->ends_at }}</p>
                    <p>Costs: {{ $subscription->price }}</p>
                    <p>Next Payment: {{ $subscription->renewal_at }}</p>
                    <p>Subscription type: {{ $subscription->billing_cycle }}</p>
                </div>

                <div class="mt-4">
                    <h3 class="font-medium text-xl">What you get</h3>
                    <ul class="list-disc list-inside text-sm text-gray-400 flex flex-col gap-4">
                        @foreach ($subscription->package->entitlements as $entitlement)
                            <li>
                                <span class="min-w-48 inline-block">{{ $entitlement->key }}</span>
                                @php
                                    if(is_array($entitlement->value)){
                                        foreach($entitlement->value as $value){
                                            echo $value;
                                        }
                                    } else {
                                        echo $entitlement->value;
                                    }
                                @endphp
                            </li>
                        @endforeach
                    </ul>
                </div>
            </x-filament::card>
        </div>
    @else
        <div class="text-center py-10 flex flex-col gap-8 items-center">
            <p class="text-gray-400">You don’t have an active subscription.</p>
            <x-filament::button tag="a" href="">
                Choose a Plan
            </x-filament::button>
        </div>
    @endif
</x-filament-panels::page>
