<?php

namespace App\Exports\Products;

use App\Models\CatalogProducts;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ProductsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.exports.products.products-list-export', [
            'products' => CatalogProducts::all()
        ]);
    }
}
