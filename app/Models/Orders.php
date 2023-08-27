<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public function saleNote(){
        return $this->belongsTo(SalesNote::class,'id_order','id_order');
    }

    public function productOrder(){
        return $this->hasMany(ProductsOrder::class,'id_order','id_order');
    }

    public function user(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function catalogPaymentMethod(){
        return $this->belongsTo(CatalogPaymentMethods::class,'id_catalog_payment_method','id_catalog_payment_method');
    }
}
