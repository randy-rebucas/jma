<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Supplier;
use App\Models\User;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search;

    public function delete($id): void
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        $user = User::find($supplier->user->id);
        $user->delete();

        $this->dispatch('supplier-deleted');
    }
    
    #[On('supplier-created')]
    #[On('supplier-updated')]
    #[On('supplier-deleted')]
    public function render()
    {
        $suppliers = Supplier::search('first_name', $this->search)->paginate(10);
        return view('livewire.supplier.index', compact('suppliers'));
    }
}
