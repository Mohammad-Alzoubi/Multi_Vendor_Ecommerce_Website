<?php

use Gloudemans\Shoppingcart\Facades\Cart;


/** Set Sidebar item active */

function setActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

/** Check if product have discount */
function checkDiscount($product): bool
{
    $currentDate = date('Y-m-d');

    if($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }
    return false;
}

/** calculate discount percent */
function calculateDiscountPercent($originalPrice, $discountPrice): float|int
{
    $discountAmount  = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice) * 100;

    return round($discountPercent);
}

/** Check the product type */
function productType($type): string
{
    return match ($type) {
        'new_arrival'      => 'New',
        'featured_product' => 'Featured',
        'top_product'      => 'Top',
        'best_product'     => 'Best',
        default => '',
    };
}

/** get total cart amount */
function getCartTotal(){
    $total = 0;
    foreach (Cart::content() as $product){
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}
