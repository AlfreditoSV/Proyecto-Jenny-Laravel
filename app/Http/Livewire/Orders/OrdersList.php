<?php

namespace App\Http\Livewire\Orders;

use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\Log\LogsController;
use App\Models\Orders;
use Livewire\Component;
use Livewire\WithPagination;

use App\Traits\Alerts;

class OrdersList extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $id_user = auth()->user()->id;
        $rol = auth()->user()->id_catalog_rol;
        switch ($rol) {
            case 1:
                $orders = Orders::with(['saleNote', 'productOrder'])->where('folio_auto_facturacion', 'like', "%{$this->search}%")->orderBy('id_order', 'DESC')->paginate(10);
                break;
            case 2:
                if ($this->search == null) {
                    $orders = Orders::with(['saleNote', 'productOrder'])->where('id_user', $id_user)->orderBy('id_order', 'DESC')->paginate(10);
                } else {
                    $orders = Orders::with(['saleNote', 'productOrder'])->where('id_user', $id_user)->where(function ($query) {

                        $query->where('id_order', 'like', "%{$this->search}%")->orWhereHas('saleNote', function ($query) {

                            $query->where('folio_sale_note', 'like', "%{$this->search}%");
                        });
                    })->orderBy('id_order', 'DESC')->paginate(10);
                }
                break;
        }
        return view('livewire.orders.orders-list')->with('orders', $orders);
    }

    public function export()
    {
        $this->alert('warning', 'Éxito', 'Descaga de archivo iniciada');
        $export = new OrdersController();
        return $export->export();
    }
}
