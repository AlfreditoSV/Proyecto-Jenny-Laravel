<?php

namespace App\Http\Controllers\Sinube;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Products\ProductsController;
use App\Models\Orders;
use App\Models\Companies;
use App\Models\CatalogPaymentMethods;
use Illuminate\Http\Request;
use App\Traits\Sinube;
use App\Traits\Validate;
use Illuminate\Support\Facades\Http;
use stdClass;
use SimpleXMLElement;

use Exception;

class SinubeController extends Controller
{
    use Sinube;
    use Validate;

    const URL_GETPOST_SINUBE = "http://getpost.si-nube.appspot.com/getpost";

    const URL_BLOB_SINUBE = "http://ep-dot-si-nube.appspot.com/blob?par=";

    static function consultar()
    {
        $cursor = null;
        $products = array();
        $item_product = array();
        do {
            //echo "<br> Iniciando consulta";
            $resultado  = self::querySinube($cursor);
            
            $temporal   = explode('¬', $resultado);
            $linea_re   = explode('|', $temporal[0]);
            $cursor     = ($linea_re[1] == '&NullSiNube;') ? null : $linea_re[1];

            foreach ($temporal as $li) {
                $products[] = $li;
            }
        } while ($cursor != null);
        
        foreach ($products as $key => $product) {
            if ($key == 0) {
                continue;
            }
            $linea_re   = explode('|', str_replace("&EnterSiNube;","",$product,));

            if (count($linea_re) == 13) {
            $item_product[] = [

                'empresa'      => $linea_re[0],
                'existencia'      => $linea_re[1],
                'producto'      => $linea_re[2],
                'descripcion'   => $linea_re[5],
                'marca'           => $linea_re[6] ?? "sin marca",
                'categoria'   => $linea_re[7],
                'unidad'       => $linea_re[8] == 'PIEZA' ? 'PZA' : $linea_re[8],
                'precio'        => $linea_re[10],
                'precioConIva'  => self::calculatePriceWithIVA($linea_re[10], self::PORCENTAJE_IVA),
                'precioMinimo'    => $linea_re[11] ?? 0,
                'status' => $linea_re[9] == 'true' ? 1 : 0,


            ];
         }
        }
        return $item_product;
        
    }

    static function querySinube($cursor = null)
    {
        $store = "CAPITAL SAPI";
        $price_list = "ADVENTA";
        $urlf = self::URL_GETPOST_SINUBE;
        $empresa    = 'DOD021211S63';
        $usuario    = 'contabilidad.diodi10@gmail.com';
        $password   = 'KEPF2R3E';
        $cursor     = ($cursor == null) ? '' : " CURSOR {$cursor}";
        $consulta   = "SELECT L.empresa,
        L.existencia,
        L.producto,
        L.sucursal,
        L.almacen,
        P.descripcion,
        P.marca, 
        P.codigoAuxiliar,
        P.unidad,
        P.activo,
        PP.precio,
        PP.precioMinimo,
        PP.listaPrecios 
        FROM DbInvProductoLote AS L INNER JOIN DbProducto as P 
        ON P.producto = L.producto AND P.empresa = L.empresa 
        INNER JOIN DbProductoPrecio AS PP 
        ON PP.producto = P.producto AND PP.empresa = P.empresa 
        WHERE L.almacen= '" . $store . "'" .
            " AND L.empresa ='DOD021211S63' AND PP.listaPrecios = '" . $price_list . " '" .
            " AND P.activo=true {$cursor} ";

        //$urlf       = "http://getpost.facturanube.appspot.com/getpost";   

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlf);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "tipo=3&emp={$empresa}&suc=Matriz&usu={$usuario}&pas={$password}&cns={$consulta}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultado = curl_exec($ch);
        curl_close($ch);
        return $resultado;
    }
    static function createSalesNote(int $id_order, string $store)
    {


            $urlf = self::URL_BLOB_SINUBE;
            $id_order = $id_order;
            $order = Orders::with([
                'catalogPaymentMethod',
                'productOrder',
                'productOrder.catalogProduct',
                'user',
                'user.usercompany',

            ])->where('id_order', $id_order)->get();

            $emisor_company = Companies::where('id_company', 1)->get();
            $store = $store;
            $sucursal = "Matriz";
            $permiteAgregarProductosNoInv = 0;
            $comprobante = new stdClass();
            $receptor = new stdClass();

            $comprobante->rfcEmisor = $emisor_company[0]->rfc_company;
            $comprobante->sistema = "TuHogarConSentido";
            $comprobante->almacen = $store;
            $comprobante->sucursal = $sucursal;
            $comprobante->folioAutofacturacion = $order[0]->folio_auto_facturacion;
            $comprobante->permiteAgregarProductosNoInv = $permiteAgregarProductosNoInv;
            $comprobante->observacion = $order[0]->observation_order;
            $comprobante->formaDePago = $order[0]->catalogPaymentMethod->codigo_catalog_payment_methods;
            $comprobante->subtotal = $order[0]->total_coust_out_vat_order;
            $comprobante->referencia = "Prueba de pedido";
            $comprobante->porcentajeIVA = ($order[0]->vat_order * 100);
            $comprobante->descuento = $order[0]->discount_order;
            $comprobante->montoIVA = ($order[0]->total_coust_order - $order[0]->total_coust_out_vat_order);
            $comprobante->total = $order[0]->total_coust_order;
            $comprobante->difZonaHoraria = self::DIFERENCIA_HORARIA;
            $comprobante->monedaSinube = self::MONEDA_SINUBE;

            if ($order[0]->user->person_type_user == 0) {
                $receptor->rfc = $order[0]->user->usercompany->rfc_company;
                $receptor->razonSocial = $order[0]->user->usercompany->razon_social_company;
                $receptor->esPersonaFisica = "0";
            }
            $xml = '<?xml version="1.0" encoding="utf-8"?>';
            $xml .= <<<XML
        
        <Comprobante rfcEmisor="{$comprobante->rfcEmisor}" sistema="{$comprobante->sistema}" almacen="{$comprobante->almacen}" sucursal="{$comprobante->sucursal}" codigoReporte="NOTA DE VENTA-DIODI" folioAutofacturacion="{$comprobante->folioAutofacturacion}" permiteAgregarProductosNoInv="{$comprobante->permiteAgregarProductosNoInv}" observacion="ID DEL PEDIDO # {$comprobante->observacion}" referencia="{$comprobante->referencia}" formaDePago="{$comprobante->formaDePago}" descuento="{$comprobante->descuento}" subtotal="{$comprobante->subtotal}" montoIVA="{$comprobante->montoIVA}" porcentajeIVA="{$comprobante->porcentajeIVA}" monedaSinube="{$comprobante->monedaSinube}" total="{$comprobante->total}" difZonaHoraria="{$comprobante->difZonaHoraria}">
          <Receptor rfc="{$receptor->rfc}" razonSocial="{$receptor->razonSocial}" esPersonaFisica="{$receptor->esPersonaFisica}"/>
          <Conceptos>
          
XML;

            foreach ($order[0]->productOrder as $product) {
                

                $descuento = 0;
                $monto_sin_iva = $product->catalogProduct->price_sinube * $product->quantity_products_order;
                $montoIVA = round(($monto_sin_iva * .16), 2);
                $subtotalDet = $monto_sin_iva - $descuento;
                $productoSinube=$product->catalogProduct->id_product_sinube;
                $description_product=$product->catalogProduct->description_product;
                $cantidad=$product->quantity_products_order;
                $unidadSinube=$product->catalogProduct->unit_catalog_product;
                $valorUnitario=$product->catalogProduct->price_sinube;


                $xml .= <<<XML

            <Concepto productoSinube="{$productoSinube}" descripcion='{$description_product}' cantidad="{$cantidad}" unidadSinube="{$unidadSinube}" valorUnitario="{$valorUnitario}" descuento="0" tipoIVA="Causa IVA" montoBaseIVA="{$monto_sin_iva}" montoIVA="{$montoIVA}" importe="{$monto_sin_iva}" subtotalDet="{$subtotalDet}"/>
XML;
            }

            $xml .= '</Conceptos></Comprobante>';
            $par = 'tipo=7
emp=DOD021211S63
suc=Matriz
usu=contabilidad.diodi10@gmail.com
pwd=KEPF2R3E';

            $par64 = base64_encode($par);
            $url = $urlf . $par64;
            $headers = [
                "Content-type: text/xml", "Content-length: " . strlen($xml), "Connection: close",
            ];
            //Inicio de método de conexión al POST
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url); //Dependiendo si es SiNube o FacturaNube se asigna la URL
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            //Impresión del resultado
            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                error_log('cURL error al intentar conectarse a ' . $url . ': ' . curl_error($ch));
            }
            curl_close($ch);

            $xml_info = new SimpleXMLElement($result);
            $xml_info = json_encode($xml_info);
            return $xml_info;
    }
}
