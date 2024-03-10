<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public $fromDate;

    public $toDate;

    public function filter()
    {
        dd($this->toDate);
    }

    public function render()
    {
        return view('livewire.report.index');
    }
}
