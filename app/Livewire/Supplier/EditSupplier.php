<?php

namespace App\Livewire\Supplier;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use App\Models\Supplier;
class EditSupplier extends ModalComponent
{
    public $first_name;
    public $last_name;
    public $phone_number;
    public $company_name;
    public $comments;

    public Supplier $supplier;

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
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required',
        'company_name' => 'required',
        'comments' => 'string|max:1000'
    ];
    public function mount(Supplier $supplier)
    {
        $this->supplier = $supplier;

        $this->first_name = $this->supplier->first_name; // or however you have it.
        $this->last_name = $this->supplier->last_name;
        $this->company_name = $this->supplier->company_name;
        $this->comments = $this->supplier->comments;
        $this->phone_number = $this->supplier->phone_number;
    }

    public function update(): void
    {
        $validated = $this->validate();

        $this->supplier->update($validated);

        $this->dispatch('supplier-updated');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.supplier.edit-supplier');
    }
}
