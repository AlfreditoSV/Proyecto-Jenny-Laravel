<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogRoles extends Model
{
    use HasFactory;
    protected $table = 'catalog_roles';
    protected $primaryKey = 'id_catalog_rol';
}
