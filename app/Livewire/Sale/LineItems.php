<?php

namespace App\Livewire\Sale;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\Attributes\On;

class LineItems extends Component
{

    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function remove($rowId): void
    {
        Cart::remove($rowId);
        $this->dispatch('removeItem', $rowId);
    }
    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        Cart::destroy();
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

    #[On('addItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function render()
    {
        $content = Cart::content();
        return view('livewire.sale.line-items', compact('content'));
    }
}
