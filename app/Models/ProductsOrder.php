<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsOrder extends Model
{
    use HasFactory;

    protected $table = 'products_order';

    public function catalogProduct(){
        return $this->belongsTo(CatalogProducts::class,'id_product_sinube','id_product_sinube');
    }
}
