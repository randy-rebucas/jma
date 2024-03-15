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
    public $description;
    public $price;
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
        'name' => 'required|string|max:255|unique:' . Item::class,
        'description' => 'string|max:1000',
        'price' => 'required',
        'reorder_level' => 'required|numeric',
        'receiving_quantity' => 'required|numeric',
        'category_id' => 'required',
        'supplier_id' => 'required'
    ];

    public function mount()
    {
        $this->categories = Category::pluck('name', 'id');
        $this->suppliers = Supplier::pluck('company_name', 'id');
    }

    public function submit()
    {
        $validated = $this->validate();

        $validated['price'] = $this->price;

        Item::create($validated);

        $this->dispatch('item-created');

        $this->closeModal();
    }
    
    public function render()
    {
        return view('livewire.item.create-item');
    }
}
