<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        Cart::instance('default')->remove($rowId);
        $this->dispatch('removeItem', $rowId);
    }
    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        Cart::instance('default')->destroy();
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
        Cart::instance('default')->update($id, $action);
    }

    #[On('addItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function render()
    {
        $content = Cart::instance('default')->content();
        return view('livewire.pos.line-items', compact('content'));
    }
}
