<?php

namespace App\Livewire\Item;

use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;
use Barryvdh\Debugbar\Facades\Debugbar;

class CreateItem extends ModalComponent
{

    public $name;
    public $slug;
    public $code;
    public $item_number;
    public $description;
    public $cost_price;
    public $unit_price;
    public $reorder_level;
    public $receiving_quantity;
    public $category_id;
    public $supplier_id;
    public $categories = [];
    public $suppliers = [];

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'string|max:255',
        'item_number' => 'string|max:255',
        'description' => 'string|max:1000',
        'cost_price' => 'required',
        'unit_price' => 'required',
        'reorder_level' => 'required|numeric',
        'receiving_quantity' => 'required|numeric',
        'category_id' => 'required',
        'supplier_id' => 'required'
    ];

    public function mount()
    {
        $this->code = Str::upper(Str::random(8));

        $this->categories = Category::pluck('name', 'id');
        $this->suppliers = Supplier::pluck('company_name', 'id');
    }

    public function submit()
    {
        try {
            //code...
            $validated = $this->validate();
    
            $validated['cost_price'] = $this->cost_price;
            $validated['unit_price'] = $this->unit_price;
            $validated['slug'] = Str::slug($this->name);
            
            Item::create($validated);
    
            $this->dispatch('item-created');
    
            $this->closeModal();
        } catch (\Throwable $e) {
            Debugbar::addThrowable($e);
        }
    }
    public function render()
    {
        return view('livewire.item.create-item');
    }
}
