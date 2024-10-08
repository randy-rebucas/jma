<?php

namespace App\Livewire\Setting\Form;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Upload extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $photo;

    public function uploadLogo()
    {
        $name = $this->photo->getClientOriginalName();
        $path = $this->photo->storeAs('images', $name, 'public');

        $item = Setting::where('key', 'business_logo')->first();

        if (empty($item)) {
            Setting::create([
                'key' => 'business_logo',
                'value' => $path,
            ]);
        } else {
            Setting::where('key', 'business_logo')->update(['value' => $path]);
        }
    }

    public function render()
    {
        return view('livewire.setting.form.upload');
    }
}
