<?php

namespace App\Livewire\Item;

use App\Models\Category;
use App\Models\Item;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class EditItem extends ModalComponent
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
    public Item $item;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'string|max:255',
        'item_number' => 'string|max:255',
        'description' => 'string|max:1000',
        'cost_price' => 'required|decimal:2',
        'unit_price' => 'required|decimal:2',
        'reorder_level' => 'required|numeric',
        'receiving_quantity' => 'required|numeric',
        'category_id' => 'required'
    ];

    public function mount(Item $item)
    {
        $this->item = $item;

        $this->categories = Category::pluck('name', 'id');

        $this->name = $this->item->name;
        $this->code = $this->item->code;
        $this->item_number = $this->item->item_number;
        $this->description = $this->item->description;
        $this->cost_price = number_format($this->item->cost_price, 2);
        $this->unit_price = number_format($this->item->unit_price, 2);
        $this->reorder_level = $this->item->reorder_level;
        $this->receiving_quantity = $this->item->receiving_quantity;
        $this->category_id = $this->item->category->id;
    }

    public function update(): void
    {
        $this->validate();

        $this->item->update([
            'name' => $this->name,
            'code' => $this->code,
            'item_number' => $this->item_number,
            'description' => $this->description,
            'cost_price' => $this->cost_price,
            'unit_price' => $this->unit_price,
            'reorder_level' => $this->reorder_level,
            'receiving_quantity' => $this->receiving_quantity,
            'slug' => Str::slug($this->name),
            'category_id' => $this->category_id
        ]);

        $this->dispatch('item-updated');

        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.item.edit-item');
    }
}
