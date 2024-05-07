<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;


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

/** get payable total amount */
function getMainCartTotal(){
    if (Session::has('coupon')){
        $coupon   = Session::get('coupon');
        $subTotal = getCartTotal();

        if ($coupon['discount_type'] === 'amount'){

            $total = $subTotal - $coupon['discount'];
            return $total;
        }elseif ($coupon['discount_type'] === 'percent'){

            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            $total    = $subTotal - $discount;
            return $total;
        }
    }else {
        return getCartTotal();
    }
}


/** get cart discount coupon */
function getCartDiscount(){
    if (Session::has('coupon')){
        $coupon   = Session::get('coupon');
        $subTotal = getCartTotal();

        if ($coupon['discount_type'] === 'amount'){
            $discount = $coupon['discount'];
            return $discount;
        }elseif ($coupon['discount_type'] === 'percent'){

            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            return $discount;
        }
    }else {
        return 0;
    }
}

/** get selected shipping method from session */
function getShippingFee(){
    if (Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    }else {
        return 0;
    }
}

/** get payable amount page payment */
function getFinalPayableAmount(){
    return getMainCartTotal() + getShippingFee();
}

