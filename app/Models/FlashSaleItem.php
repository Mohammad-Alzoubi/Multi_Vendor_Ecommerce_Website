<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleItem extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'flash_sale_id', 'show_at_home', 'status'];

    public function flashSale()
    {
        return $this->belongsTo(FlashSale::class) ;
    }

    public function product()
    {
        return $this->belongsTo(Product::class) ;
    }
}
