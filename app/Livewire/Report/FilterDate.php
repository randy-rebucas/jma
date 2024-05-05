<?php

namespace App\Livewire\Report;

use Livewire\Component;

class FilterDate extends Component
{
    public $fromDate;

    public $toDate;

    public $isPrintDisabled = true;
    public function filter()
    {
        $this->isPrintDisabled = false;
        
        $this->dispatch('dateFiltered', from: $this->fromDate, to: $this->toDate);
    }

    public function print()
    {
        $this->dispatch('printDateFiltered', from: $this->fromDate, to: $this->toDate);
    }

    public function render()
    {
        return view('livewire.report.filter-date');
    }
}
