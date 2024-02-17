<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use App\Facades\Cart;

class LineItems extends Component
{
    protected $content;
    protected $listeners = ['addItem', 'saleCompleted', 'saleCanceled'];
    public function mount(): void
    {
        $this->addItem();
    }

    public function saleCompleted()
    {
        $this->addItem();
    }
    public function saleCanceled()
    {
        $this->addItem();
    }
    public function addItem()
    {
        $this->content = Cart::content();
    }
    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $id): void
    {
        Cart::remove($id);
        $this->addItem();

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
        $this->addItem();
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
        $this->addItem();
    }
    public function render()
    {
        return view('livewire.sale.line-items', [
            'content' => $this->content,
        ]);
    }
}
