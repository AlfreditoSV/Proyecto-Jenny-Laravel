<?php

namespace App\Http\Livewire\Products;

use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\Products\ProductsController;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CatalogProducts;
use Maatwebsite\Excel\Facades\Excel;


class ProductsList extends Component
{
    use WithPagination;
    use WithFileUploads;

    
    public $search;
    public $sort = 'id_product';
    public $direction = 'desc';
    public $file;
    public $date;
    public $data_file = [];
    
    public $products;
    protected $listeners = ['orderDataSubmitted' => 'createOrder'];
    

    public function mount()
    {
        $this->products = CatalogProducts::where('asset', 1)->orderBy($this->sort, $this->direction)->get();
    }

    public function render()
    {
        return view('livewire.products.products-list');
    }

    public function updatingSearch()
    {
        $search = $this->search;
        if($search == null || $search == ''){
            $this->products = CatalogProducts::where('asset', 1)->orderBy($this->sort, $this->direction)->get();
            return;
        }

        $this->products=CatalogProducts::where('asset', 1)->where(function ($query) {
            $query->where('id_product', 'like', "%{$this->search}%")->orWhere('description_product', 'like', "%{$this->search}%")->orWhere('brand_product', 'like', "%{$this->search}%");
        })->orderBy($this->sort, $this->direction)->get();
        $this->resetPage();
    }
    public function orderTable($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc')
                $this->direction = 'asc';
            else
                $this->direction = 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
    public function updatedFile($file)
    {
        if ($this->file != null) {

            $this->validate([
                'file' => 'required|mimes:xls,xlsx',
            ]);
            $file = $this->file;
            $importedData = Excel::toCollection(null, $this->file)[0]; // Passing null as first argument
            $this->data_file = $importedData->toArray();
            $this->file = null;
        }
    }

    public function createOrder($value)
    {

        
        $result = OrdersController::createOrder($value);
        if ($result['status'] == 'success') {
            $id_order = $result['id_order'];
            $id_user = $result['id_user'];
            OrdersController::orderNotification($id_user, $id_order, 2);
            $this->products=CatalogProducts::where('asset', 1)->orderBy($this->sort, $this->direction)->get();
            $this->alert('success', 'Éxito', $result['message']);
        } else if ($result['status'] == 'error') {
            $this->alert('error', 'Error', $result['message']);
            return;
        }
    }

    public function updateTable()
    {
        $result = ProductsController::asyncProductsBySinube();
        if ($result != null && count($result) > 0) {
            $this->render();
            $this->alert('success', 'Éxito', 'Se han actualizado los datos');
        } else {
            $this->alert('error', 'Error', 'No se han actualizado los datos');
        }
    }

}
