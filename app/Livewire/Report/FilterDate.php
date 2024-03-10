<?php

namespace App\Livewire\Report;

use Livewire\Component;

class FilterDate extends Component
{
    public $fromDate;

    public $toDate;

    public function filter()
    {
        $this->dispatch('dateFiltered', from: $this->fromDate, to: $this->toDate);
    }

    public function render()
    {
        return view('livewire.report.filter-date');
    }
}
