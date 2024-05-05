<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Carbon\Carbon;

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
        return redirect()->route('print-report', [
            'from' => date('Y-m-d', strtotime($this->fromDate)),
            'to' => date('Y-m-d', strtotime($this->toDate))
        ]);
    }

    public function render()
    {
        return view('livewire.report.filter-date');
    }
}
