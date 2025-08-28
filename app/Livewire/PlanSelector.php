<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class PlanSelector extends Component
{
    public $prices = [];   // array of price models or transformed array

    public $selected = null;

    public function mount($prices, $default = null): void
    {
        $this->prices = $prices;
        $this->selected = $default /* ?? ($prices[0]['id'] ?? null) */;
    }

    /** Called when a price has been selected */
    public function select($priceId): void
    {
        $this->selected = $priceId;
    }

    /** Called when the user clicks the continue button */
    public function continue(): void
    {
        $this->dispatch('subscribe', priceId: $this->selected);
    }

    public function render(): View
    {
        return view('livewire.plan-selector');
    }
}
