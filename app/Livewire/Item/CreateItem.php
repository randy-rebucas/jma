<?php

namespace App\Livewire\Item;

use App\Models\Category;
use App\Models\Item;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

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
    public $categories = [];
    public $selectedCategory;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'string',
        'code' => 'string|max:255',
        'item_number' => 'string|max:255',
        'description' => 'string|max:1000',
        'cost_price' => 'required',
        'unit_price' => 'required',
        'reorder_level' => 'required|numeric',
        'receiving_quantity' => 'required|numeric',
        'category_id' => 'required'
    ];

    public function mount()
    {
        $this->code = Str::upper(Str::random(8));

        $this->categories = Category::pluck('name', 'id');
    }

    public function submit()
    {
        $validated = $this->validate();

        $validated['cost_price'] = number_format($this->cost_price, 2);
        $validated['unit_price'] = number_format($this->unit_price, 2);
        $validated['slug'] = Str::slug($this->name);

        Item::create($validated);

        $this->dispatch('item-created');

        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.item.create-item');
    }
}
