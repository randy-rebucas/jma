<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{

    public function render()
    {
        // logo
        // lines_per_page
        // dateformat
        // timeformat

        // baclup db
        return view('livewire.setting.index');
    }
}
