<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use App\Facades\Cart;
use Livewire\Attributes\On;

class LineItems extends Component
{
    public $content;

    #[On('addItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function getCartContents()
    {
        $this->content = Cart::content();
    }
    public function mount(): void
    {
        $this->getCartContents();
    }

    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function remove($id): void
    {
        Cart::remove($id);

        $this->dispatch('removeItem', $id);
    }
    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        Cart::clear();
        $this->dispatch('clearItem');
    }
    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
    }
    public function render()
    {
        return view('livewire.sale.line-items');
    }
}
