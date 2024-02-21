<?php

namespace App\Livewire\Item;

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

    public function delete($id): void
    {
        $item = Item::find($id);
        $item->delete();

        $this->dispatch('item-deleted');
    }

    #[On('item-created')]
    #[On('item-updated')]
    #[On('item-deleted')]
    public function render()
    {
        $items = Item::search('name', $this->search)->paginate(10);
        return view('livewire.item.index', compact('items'));
    }
}
