<?php

namespace App\Livewire\Expense;

use App\Models\Expense;
use LivewireUI\Modal\ModalComponent;

class EditExpense extends ModalComponent
{
    public $name;

    public $amount;

    public $description;

    // public $expenseId;

    public Expense $expense;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscapeIsForceful(): bool
    {
        return false;
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'string',
        'amount' => 'required'
    ];

    public function mount()
    {
        // $expense = Expense::find($this->expenseId);

        $this->name = $this->expense->name; // or however you have it.
        $this->description = $this->expense->description;
        $this->amount = $this->expense->amount;

    }

    public function update(): void
    {
        $validated = $this->validate();

        $this->expense->update($validated);

        $this->dispatch('expense-updated');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.expense.edit-expense');
    }
}
