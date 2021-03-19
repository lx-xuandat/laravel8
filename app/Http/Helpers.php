<?php

use App\Models\Order;
use App\Models\ProductOrder;

if (!function_exists('showCartNumber')) {
    function showCartNumber()
    {
        $cartNumber = 0;
        $currentUserId =  auth()->id();

        $currentOrder = Order::where('user_id', $currentUserId)->where('status', 1)->first();

        if (!$currentOrder) {
            $cartNumber = ProductOrder::where('order_id', $currentOrder->id)->sum('quantity');
        }
        return $cartNumber;
    }
}
