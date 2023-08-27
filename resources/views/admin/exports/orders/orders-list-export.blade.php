<table>
    <thead>
        <tr>
        <th>ID</th>
        <th>Folio</th>
        <th>Cantidad_productos</th>
        <th>Total</th>
        <th>Total_sin_iva</th>
        <th>IVA</th>
        <th>Estado</th>
        <th>Fecha de alta</th>
        <th>Fecha de actualización</th>
        <th><span class="">Acciones</span>
            </th>
                
    </thead>
    <tbody>
        @foreach ($orders as $order => $value)
        <tr>
            <td>{{ $value->id_order }}</td>
            <td>{{ $value->folio_auto_facturacion }}</td>
            <td>{{ $value->quantity_products_order }}</td>
            <td>{{ $value->total_coust_order }}</td>
            <td>{{ $value->total_coust_out_vat_order }}</td>
            <td>{{ $value->vat_order }}</td>
            <td>{{ $value->status_order }}</td>
            <td>{{ $value->created_at }}</td>
            <td>{{ $value->updated_at ??'-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>