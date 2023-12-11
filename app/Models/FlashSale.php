<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;
    protected $fillable = ['end_date'];


    public function flashSaleItems()
    {
        return $this->hasMany(flashSaleItem::class) ;
    }
}
