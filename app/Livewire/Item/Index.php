<?php

namespace App\Livewire\Item;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Item;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search;

    public $categories = [];
    public $category;
    public function delete($id): void
    {
        $item = Item::find($id);
        $item->delete();

        $this->dispatch('item-deleted');
    }

    public function setCategory($id)
    {
        $this->category = $id;
    }

    public function print() {
        return redirect()->route('print-item');
    }

    public function mount()
    {
        $this->categories = Category::pluck('name', 'id');
    }

    #[On('item-created')]
    #[On('item-updated')]
    #[On('item-deleted')]
    public function render()
    {
        $query = Item::query();

        if ($this->category) {
            $query->where('category_id', $this->category);

            // $categorySlug = $this->category;
            // $query->whereHas('category', function ($query) use ($categorySlug) {
            //     $query->where('slug', $categorySlug);
            // });
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'LIKE', '%' . $this->search . '%');
        }

        $items = $query->paginate(10);
        return view('livewire.item.index', compact('items'));
    }
}
