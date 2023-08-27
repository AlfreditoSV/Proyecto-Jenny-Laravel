<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Sinube\SinubeController;
use App\Http\Controllers\Log\LogsController;
use App\Mail\Admin\Orders\OrdersNotification as AdminOrdersNotification;
use App\Mail\Client\Orders\OrdersNotification as ClientOrdersNotification;
use App\Exports\Orders\OrdersExport;
use App\Models\CatalogProducts;
use App\Models\User;
use App\Models\Orders;
use App\Models\ProductsOrder;
use App\Models\SalesNote;
use App\Traits\App;
use App\Traits\Validate;
use App\Traits\Sinube;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;
use Exception;


class OrdersController extends Controller
{
    use App;
    use Validate;

    public function index()
    {
        return view('admin.orders.index');
    }

    /**
     * Author: Alfredo Segura Vara <pixxo2010@gmail.com>
     * Description: Exporta la lista de ordenes de compra
     * Date: 18-08-2023
     * @return Excel
     * 
     */
    public function export()
    {

        $register = LogsController::register([
            "action" => "Exportar lista de ordenes de compra"
        ]);

        return Excel::download(new OrdersExport, 'lista_ordenes.xlsx');
    }
    /**
     * Author: Alfredo Segura Vara <pixxo2010@gmail.com>
     * Description: Creas una orden de compra del usuario
     * Date: 08-08-2023
     * @param object $data
     * @return array
     * 
     */
    static function createOrder($json)
    {
       
        try{
        $data = json_decode($json);
        
        if (empty($data)) {
            $response = [
                "status" => "error",
                "message" => "Selecciona los producto"
            ];
            return $response;
        }

        $total_count = 0;
        $total_productos = 0;
        $total_product_excedent = 0;
        $products_list_order = array();
        $product_no_exist = [];
        $product_exist = [];
        $info_total_order = new stdClass();
        $iva = self::FACTOR_TOTAL_IVA;
        $observation = "";
        $id_user = auth()->user()->id;

        if(!isset($data[0]->observation)){
            
            $result=[
                "status"=>"error",
                "message"=>"Debes agregar una observacion"
            ];

            return $result;
        }else if(trim($data[0]->observation)==""){
                $result=[
                    "status"=>"error",
                    "message"=>"Requiere una observacion"
                ];
    
                return $result;
            }

        foreach ($data as $key => $value) {
            if ($key == 0) {
            $observation=$value->observation;
                continue;
            }
            $id_product = $value->id;
            $cantidad_productos = self::validateNumber($value->cantidadProductos);
            $cantidad_Excendete = self::validateNumber($value->cantidadExcedente);

            if ($cantidad_productos <= 0) {
                $response = [
                    "status" => "error",
                    "id_product" => $id_product,
                    "message" => "Debes agregar al menos un producto"
                ];
                return $response;
            }

            $product = CatalogProducts::where('id_product_sinube', $id_product)->get();
            if (empty($product)) {
                $product_no_exist[] = $value;
                continue;
            }

            if ($product[0]->existence_product < $cantidad_productos) {
                $response = [
                    "status" => "error",
                    "id_product" => $id_product,
                    "message" => "El articulo:$id_product no cuenta con la existencia suficiente"
                ];
                return $response;
            }

            $total_count += ($product[0]->price_sinube_with_vat * $cantidad_productos);
            $total_productos += $cantidad_productos;
            $total_product_excedent += $cantidad_Excendete;
            $update = [
                "id_product" => $id_product,
                "existence_product" => $product[0]->existence_product - $cantidad_productos
            ];
            $store_product=[
                "quantity"=>$value,
                "data"=>$product[0]
                
            ];
            $products_list_order[]=$update;
            $product_exist[] = $store_product;
        }

        $info_total_order->id_user = $id_user;
        $info_total_order->total_count = $total_count;
        $info_total_order->total_productos = $total_productos;
        $info_total_order->total_product_excedent = $total_product_excedent;
        $info_total_order->total_coust_out_vat = self::calculatePriceWithoutIVA($total_count, $iva);
        $info_total_order->observation = $observation;
        $info_total_order->vat = self::TASA_IVA;
        $order = self::storeOrder($info_total_order);

        foreach ($product_exist as $key => $value) {
            $store = [
                "id_order" => $order,
                "id_product_sinube" => $value['data']->id_product_sinube,
                "price_unit_sinube_product_order"=> $value['data']->price_sinube,
                "vat_product_order"=> self::TASA_IVA,
                "quantity_products_order" => $value['quantity']->cantidadProductos,
                "quantity_excedent_products_order" => $value['quantity']->cantidadExcedente == "" ? 0 : $value['quantity']->cantidadExcedente,
                "created_at" => self::getCurrentTime()
            ];

            ProductsOrder::insert($store);
        }
        LogsController::register([
            "action" => "Crear orden de compra",
            "id_order" => $order
        ]);

        $nota=self::salesNote($order);
        if($nota['status']=="error"){
            $response = [
                "status" => "error",
                "message" => "Error al crear la orden de compra: ".$nota['message']
            ];
            return $response;
        }
        foreach($products_list_order as $key=>$update){
            $id_product=$update['id_product'];
            $update_data=['existence_product'=>$update['existence_product']];
            CatalogProducts::where("id_product_sinube", $id_product)->update($update_data);
        }

        return $nota;
    
        
    
    }catch(Exception $e){
        $response = [
            "status" => "error",
            "message" => "Error al crear la orden de compra: ".$e->getMessage()
        ];
        return $response;
    }
}

    /**
     * Author: Alfredo Segura Vara <pixxo2010@gmail.com>
     * Description: Almacena la orden de compra del usuario
     * Date: 08-08-2023
     * @param object $data
     * @return array
     * 
     */
    static function storeOrder($data)
    {
        try {
            $store = [
                "id_user" => $data->id_user,
                "observation_order" => $data->observation,
                "quantity_products_order" => $data->total_productos,
                "total_coust_order" => $data->total_count,
                "total_coust_out_vat_order" => $data->total_coust_out_vat,
                "vat_order" => $data->vat,
                "status_order" => 0,
                "created_at" => App::getCurrentTime(),
            ];

            $id_order = Orders::insertGetId($store);

            $folio = Sinube::folioAutofacturacion($id_order);
            $data_update = ["folio_auto_facturacion" => $folio];
            $insert_folio = Orders::where("id_order", $id_order)->update($data_update);
            return $id_order;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    static function salesNote($id_order)
    {
        try {
            $store = "CAPITAL SAPI";

            $descuento = 0;

            $sale_note = json_decode(SinubeController::createSalesNote($id_order, $store));
            if (isset($sale_note->folio)) {
                $store = [
                    "id_order" => $id_order,
                    "folio_sale_note" => $sale_note->folio,
                    "report_sale_note" => $sale_note->pdf,
                    "process_type_sale_note" => $sale_note->TipoProceso,
                    "created_at" => $sale_note->fechaNotaVenta
                ];
                $insert = SalesNote::insertGetId($store);
                $result = [
                    "status" => "success",
                    "message" => "Nota de venta creada correctamente folio:$sale_note->folio",
                    "folio" => $sale_note->folio,
                    "id_order" => $id_order,
                    "id_user"=>auth()->user()->id
                ];
                return $result;
            } else {
                $result = [
                    "status" => "error",
                    "message" => "Error al crear la nota de venta: " . $sale_note->error
                ];
                return $result;
            }
        } catch (Exception $e) {
            $result = [
                "status" => "error",
                "message" => "Error al crear la nota de venta: " . $e->getMessage()
            ];
            return $result;
        }
    }

    /**
     * Author: Alfredo Segura Vara <pixxo2010@gmail.com>
     * Description: Envia la notificacion de la orden de compra
     * Date: 22-08-2023
     * @param int $id_user
     * @param int $id_order
     * @param int $type 0:admin,1:client,2:admin y client
     * @return array
     */
    static function orderNotification($id_user, $id_order,$type = 0)
    {
        try {
           
                if (isset($id_user)  && isset($id_order)) {

                    $order = Orders::with([
                        'catalogPaymentMethod',
                        'saleNote',
                        'productOrder',
                        'productOrder.catalogProduct',
                        'user',
                        'user.usercompany',

                    ])->where('id_order', $id_order)
                        ->where('id_user', $id_user)
                        ->get();
                        if(count($order)>0){

                        switch($type){
                            case 0:
                                Mail::to($order[0]->user->email)->send(new AdminOrdersNotification($order));
                                break;
                            case 1:
                                Mail::to($order[0]->user->email)->send(new ClientOrdersNotification($order));
                                break;
                            case 2:
                                try{
                                    
                                Mail::to($order[0]->user->email)->send(new ClientOrdersNotification($order));

                                $users_admins=User::where('id_catalog_rol',1)->get();
                                    foreach($users_admins as $key=>$admin){
                                        Mail::to($admin->email)->send(new AdminOrdersNotification($order,$admin));
                                    }
                                    $result=[
                                        "status"=>"success",
                                        "message"=>"Notificacion enviada correctamente"
                                    ];
                                    return $result;
                                }catch(Exception $e){
                                    $result=[
                                        "status"=>"error",
                                        "message"=>"Error al enviar la notificacion: ".$e->getMessage()
                                    ];
                                    return $result;
                                }
                                break;
                            default:
                                $result=[
                                "status"=>"error",
                                "message"=>"Tipo de notificacion no valido"
                            ];
                            return $result;
                            break;
                        }
                    }else{
                        $result=[
                            "status"=>"error",
                            "message"=>"No se encontro la orden de compra"
                        ];
                        return $result;
                    }
                } else {
                            $result=[
                                "status"=>"error",
                                "message"=>"Debe enviar el id de usuario y el id de la orden de compra"
                            ];
                            return $result;
                        }
           
        } catch (Exception $e) {
            $result = [
                "status" => "error",
                "message" => "Error al crear la nota de venta: " . $e->getMessage()
            ];
            return $result;
        }
    }
}
