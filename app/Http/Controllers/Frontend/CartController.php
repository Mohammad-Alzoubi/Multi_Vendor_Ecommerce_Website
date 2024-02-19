<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /** Show cart page */
    public function cartDetails(){
        $cartItems = Cart::content();

        if (count($cartItems) === 0){
            Session::forget('coupon');
            toastr('Please add some products in you cart for view the cart page', 'warning', 'Cart is empty!');
            return redirect()->route('home');
        }
        return view('frontend.pages.cart-detail', compact('cartItems'));
    }

    /** Add item to cart*/
    public function addToCart(Request $request)
    {
        $product  = Product::findOrFail($request->product_id);

        /* Check product Quantity */
        if ($product->qty === 0){
            return response(['status' => 'error', 'message' =>'Product stock out']);
        }elseif ($product->qty < $request->qty){
            return response(['status' => 'error', 'message' =>'Quantity not available in out stock']);
        }

        $variants = [];
        $variantTotalAmount = 0;

        if ($request->has('variants_items')){
            foreach ($request->variants_items as $item_id){
                $variantItem = ProductVariantItem::findOrFail($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }


        /** Check Discount Product*/
        $productPrice = 0;
        if (checkDiscount($product)){
            $productPrice = $product->offer_price;
        }else{
            $productPrice = $product->price;
        }


        $cartData = [];

        $cartData['id']     = $product->id;
        $cartData['name']   = $product->name;
        $cartData['qty']    = $request->qty;
        $cartData['price']  = $productPrice;
        $cartData['weight'] = 1;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image']    = $product->thumb_image;
        $cartData['options']['slug']     = $product->slug;

        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Add to cart successfully!']);
    }

    /** Update Product Quantity */
    public function updateProductQTy(Request $request)
    {
        // get product id form cart
        $productId = Cart::get($request->rowId)->id;
        $product   = Product::findOrFail($productId);

        /* Check product Quantity */
        if ($product->qty === 0){
            return response(['status' => 'error', 'message' =>'Product stock out']);
        }elseif ($product->qty < $request->quantity){
            return response(['status' => 'error', 'message' =>'Quantity not available in out stock']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);

        return response(['status' => 'success', 'message' => 'Product Quantity Updated!', 'product_total' => $productTotal]);
    }

    /** get product total */
    public function getProductTotal($rowId)
    {
        $product = Cart::get($rowId);
        $total   =  ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    /** get cart total amount */
    public function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $product){
            $total += $this->getProductTotal($product->rowId);
        }
        return $total;
    }

    /** clear all cart products */
    public function clearCart()
    {
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'The cart is empty!']);
    }

    /** remove Product from cart*/
    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        toastr('Product Removed Successfully!', 'success', 'success');
        return redirect()->back();
    }

    /** Get cart count */
    public function getCartCount()
    {
        return Cart::content()->count();
    }

    /** Get all cart product */
    public function getCartProduct()
    {
        return Cart::content();
    }


    /** remove product from sidebar cart */
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);
        return response(['status' => 'success', 'message' => 'Product removed successfully!']);
    }

    /** apply Coupon*/
    public function applyCoupon(Request $request)
    {
        if ($request->coupon_code === null){
            return response(['status' => 'error', 'message' => 'Coupon Filed is required!']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();
        if ($coupon === null){
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        }elseif ($coupon->start_date > date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        }elseif ($coupon->end_date < date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Coupon is expired!']);
        }elseif ($coupon->total_used >= $coupon->quantity){
            return response(['status' => 'error', 'message' => 'You can not apply this coupon!']);
        }

        if ($coupon->discount_type === 'amount'){
            Session::put('coupon', [
               'coupon_name'   => $coupon->name,
               'coupon_code'   => $coupon->code,
               'discount_type' => 'amount',
               'discount'      => $coupon->discount,
            ]);
        }elseif ($coupon->discount_type === 'percent'){
            Session::put('coupon', [
                'coupon_name'   => $coupon->name,
                'coupon_code'   => $coupon->code,
                'discount_type' => 'percent',
                'discount'      => $coupon->discount,
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);

    }

    /** Calculation Coupon discount */
    public function couponCalculation()
    {
        if (Session::has('coupon')){
            $coupon   = Session::get('coupon');
            $subTotal = getCartTotal();

            if ($coupon['discount_type'] === 'amount'){

                $total = $subTotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            }elseif ($coupon['discount_type'] === 'percent'){

                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total    = $subTotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        }else {
            $total = getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);

        }
    }
}
