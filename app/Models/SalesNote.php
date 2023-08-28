<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesNote extends Model
{
    use HasFactory;
    protected $table = 'sales_note';
    protected $primaryKey = 'id_sale_note';
}
