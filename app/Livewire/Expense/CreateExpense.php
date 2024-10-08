<?php

namespace App\Livewire\Expense;

use Livewire\Component;
use App\Models\Expense;
use LivewireUI\Modal\ModalComponent;

class CreateExpense extends ModalComponent
{
    public $name;

    public $amount;

    public $description;

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
        'amount' => 'required'
    ];

    public function submit()
    {
        $this->validate();

        $expese = Expense::create([
            'name' => $this->name,
            'description' => $this->description,
            'amount' => $this->amount
        ]);

        $this->dispatch('expense-created');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.expense.create-expense');
    }
}
