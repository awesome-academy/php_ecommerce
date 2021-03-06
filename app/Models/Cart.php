<?php

namespace App\Models;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function addItemToCart($item, $id)
    {
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item,
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $storedItem['qty'] * $item->price;
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    public function removeItem($item, $id)
    {
        if ($this->items && array_key_exists($id, $this->items)) {
            if ($this->items[$id]['qty'] > 0) {
                $this->totalQty -= $this->items[$id]['qty'];
                $this->totalPrice -= $item->price * $this->items[$id]['qty'];
                unset($this->items[$id]);
            }
        }
    }

    public function increaseItem($item, $id)
    {
        if ($this->items && array_key_exists($id, $this->items)) {
            $this->totalQty++;
            $this->items[$id]['qty']++;
            $this->items[$id]['price'] += $item->price;
            $this->totalPrice += $item->price;
        }
    }

    public function decreaseItem($item, $id)
    {
        if ($this->items && array_key_exists($id, $this->items)) {
            $this->totalQty--;
            $this->items[$id]['qty']--;
            $this->items[$id]['price'] -= $item->price;
            $this->totalPrice -= $item->price;
            if ($this->items[$id]['qty'] <= 0) {
                unset($this->items[$id]);
            }
        }
    }
}
