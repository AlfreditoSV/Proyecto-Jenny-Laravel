<table >
    <thead >
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Categoría</th>
            <th>Precio sin iva</th>
            <th>Precio con iva</th>
            <th>Existencia</th>
            <th>Cantidad Productos</th>
            <th>Cantidad Excedente</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product => $value)
        <tr>
            <td>{{ $value->id_product }}</td>
            <td>{{ $value->description_product }}</td>
            <td>{{ $value->brand_product }}</td>
            <td>{{ $value->id_product_sinube }}</td>
            <td>{{ $value->category_product }}</td>
            <td>{{ $value->price_sinube }}</td>
            <td>{{ $value->price_sinube_with_vat }}</td>
            <td>{{ $value->existence_product }}</td>
            <td>0</td>
            <td>0</td>
        </tr>
    @endforeach
    </tbody>
</table>