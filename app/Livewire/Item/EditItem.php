<?php

namespace App\Livewire\Item;

use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class EditItem extends ModalComponent
{
    public $name;
    public $description;
    public $price;
    public $reorder_level;
    public $receiving_quantity;
    public $category_id;
    public $categories = [];
    public $supplier_id;
    public $suppliers = [];
    public Item $item;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:items,name,' . $this->item->id,
            'description' => 'string|max:1000',
            'price' => 'required',
            'reorder_level' => 'required|numeric',
            'receiving_quantity' => 'required|numeric',
            'category_id' => 'required'
        ];
    }

    public function mount(Item $item)
    {
        $this->item = $item;
        $this->categories = Category::pluck('name', 'id');
        $this->suppliers = Supplier::pluck('company_name', 'id');

        $this->name = $this->item->name;
        $this->description = $this->item->description;
        $this->price = $this->item->price;
        $this->reorder_level = $this->item->reorder_level;
        $this->receiving_quantity = $this->item->receiving_quantity;
        $this->category_id = $this->item->category->id;
        $this->supplier_id = $this->item->supplier->id;
    }

    public function update(): void
    {
        $this->validate();

        $this->item->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'reorder_level' => $this->reorder_level,
            'receiving_quantity' => $this->receiving_quantity,
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
