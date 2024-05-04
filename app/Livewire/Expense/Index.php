<?php

namespace App\Livewire\Expense;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Expense;

#[Layout('layouts.app')]
class Index extends Component
{
    public function delete($id): void
    {
        $expense = Expense::find($id);
        $expense->delete();

        $this->dispatch('expense-deleted');
    }

    #[On('expense-created')]
    #[On('expense-updated')]
    #[On('expense-deleted')]
    public function render()
    {
        $expenses = Expense::all();

        return view('livewire.expense.index', compact('expenses'));
    }
}
