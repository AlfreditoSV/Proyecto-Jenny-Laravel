<?php

namespace App\Exports\Orders;


use App\Models\Orders;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    public function view(): View
    {
        return view('admin.exports.orders.orders-list-export', [
            'orders' => Orders::all()
        ]);
    }
}
