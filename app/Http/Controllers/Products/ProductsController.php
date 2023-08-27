<?php

namespace App\Http\Controllers\Products;

use App\Exports\Products\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sinube\SinubeController;
use App\Models\CatalogProducts;
use App\Traits\App;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Illuminate\Queue\Listener;

class ProductsController extends Controller
{
    use App;


    public function index()
    {
        $products = CatalogProducts::paginate(10);
        return view('admin.products.index')->with('products', $products);
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'lista_productos.xlsx');
    }

    public function import()
    {
    }


    static function  asyncProductsBySinube()
    {
        $data_sinube = SinubeController::consultar();
        $result_async = array();
        if (isset($data_sinube)) {
            foreach ($data_sinube as $data) {

                $validate = CatalogProducts::where("id_product_sinube", $data['producto'])->get();
                
                if ( count($validate) == 0) {
                    $result = self::storeProductsBySinube($data_sinube);
                    $result_async['inserts'] = $result;
                } else{
                    $result = self::updateProductsBySinube($data_sinube);
                    $result_async['updates'] = $result;
                }
            return $result_async;
        }
        return null;
    }
}

    static function storeProductsBySinube($products)
    {
        try {
            $data = array();
            $new_products = array();
            if (isset($products)) {
                foreach ($products as $key => $product) {
                    $data = [
                        "id_product_sinube" => $product['producto'],
                        "description_product" => $product['descripcion'],
                        "brand_product" => $product['marca'],
                        "category_product" => $product['categoria'],
                        "price_sinube" => $product['precio'],
                        "price_sinube_with_vat" => $product['precioConIva'],
                        "price_minimum_sinube" => $product['precioMinimo'],
                        'existence_product' => $product['existencia'],
                        'unit_catalog_product' => $product['unidad'],
                        "created_at" => self::getCurrentTime()
                    ];
                    $new_products["id_product_" . $key] = CatalogProducts::insertGetId($data);
                }
                return $new_products;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    static function updateProductsBySinube($product)
    {
        try {
            $data = array();
            $updated_products = array();
            if (isset($product)) {
                CatalogProducts::where('asset',1)->update(['asset' => '0']);
                foreach ($product as $key => $product) {
                    if($product['existencia']>0 && $product['status'] == 1){
                    $status= 1;
                    }else{
                    $status= 0;
                }
                    $data = [
                        "description_product" => $product['descripcion'],
                        "brand_product" => $product['marca'],
                        "category_product" => $product['categoria'],
                        "price_sinube" => $product['precio'],
                        "price_sinube_with_vat" => $product['precioConIva'],
                        "price_minimum_sinube" => $product['precioMinimo'],
                        'existence_product' => $product['existencia'],
                        'unit_catalog_product' => $product['unidad'],
                        'asset' => $status,
                        "updated_at" => self::getCurrentTime()
                    ];
                    $updated_products['id_product' . $key] = CatalogProducts::where("id_product_sinube", $product['producto'])->update($data);
                }
                return $updated_products;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
