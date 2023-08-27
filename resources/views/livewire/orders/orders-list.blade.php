    <section class="bg-gray-50 py-5">
        <div class="mx-auto max-w-screen-xl px-4">
            <!-- Start coding here -->
            <div class="bg-white relative shadow-md sm:rounded-lg mb-5">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <div class="flex items-center">
                            <label for="simple-search" class="sr-only">Buscador</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                        viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" wire:model="search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                                    placeholder="Buscar folio orden" required="">
                            </div>
                        </div>

                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <div class="relative" data-te-dropdown-ref>
                                <button
                                    class="flex items-center whitespace-nowrap rounded bg-info px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#54b4d3] transition duration-150 ease-in-out hover:bg-info-600 hover:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] focus:bg-info-600 focus:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] focus:outline-none focus:ring-0 active:bg-info-700 active:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] motion-reduce:transition-none"
                                    type="button" id="dropdownMenuButton8" data-te-dropdown-toggle-ref
                                    aria-expanded="false" data-te-ripple-init data-te-ripple-color="light">
                                    ACCIONES
                                    <span class="ml-2 w-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="h-5 w-5">
                                            <path fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                                <ul class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                                    aria-labelledby="dropdownMenuButton8" data-te-dropdown-menu-ref>
                                    <li>
                                        <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                            href="#" wire:click='export' data-te-dropdown-item-ref>Descargar
                                            lista</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto p-6">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="cursor-pointer px-4 py-3">ID</th>
                            <th scope="col" class="cursor-pointer px-4 py-3">Nota de venta</th>
                            <th scope="col" class="cursor-pointer px-4 py-3">Cantidad_productos</th>
                            <th scope="col" class="cursor-pointer px-4 py-3">Total</th>
                            <th scope="col" class="cursor-pointer px-4 py-3">Total_sin_iva</th>
                            <th scope="col" class="cursor-pointer px-4 py-3">IVA</th>
                            <th scope="col" class="cursor-pointer px-4 py-3">Estado</th>
                            <th scope="col" class="cursor-pointer px-4 py-3">Fecha de alta</th>
                            <th scope="col" class="cursor-pointer px-4 py-3">Fecha de actualización</th>
                            <th scope="col" class="cursor-pointer px-4 py-3"><span class="">Acciones</span>
                            </th>

                    </thead>
                    <tbody>
                        @if (!empty($orders))

                            @foreach ($orders as $order => $value)
                                <tr class="border-b text-center">
                                    <td class="px-4 py-3">{{ $value->id_order }}</td>
                                    <td class="px-4 py-3">
                                        @if (isset($value->saleNote->folio_sale_note))
                                            {{ $value->saleNote->folio_sale_note }}
                                        @else
                                            <span
                                                class="inline-block whitespace-nowrap rounded-full bg-danger-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-danger-700">
                                                Sin nota
                                            </span>
                                        @endif

                                    </td>
                                    <td class="px-4 py-3">{{ $value->quantity_products_order }}</td>
                                    <td class="px-4 py-3">{{ $value->total_coust_order }}</td>
                                    <td class="px-4 py-3">{{ $value->total_coust_out_vat_order }}</td>
                                    <td class="px-4 py-3">
                                        {{ $value->vat_order }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($value->status_order == 0)
                                            <span
                                                class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Pendiente</span>
                                        @else
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Facturada</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $value->created_at }}</td>
                                    <td class="px-4 py-3">{{ $value->updated_at ?? '-' }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        @if (!empty($value->saleNote->report_sale_note))
                                            <div class="relative" data-te-dropdown-position="dropstart">
                                                <button id="apple-imac-27-dropdown-button" data-te-dropdown-toggle-ref
                                                    aria-expanded="false" data-te-ripple-init
                                                    data-te-ripple-color="light"
                                                    class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                                    type="button">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    </svg>
                                                </button>
                                                <ul class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                                                    aria-labelledby="dropdownMenuButton1s" data-te-dropdown-menu-ref>
                                                    <li>

                                                        <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                                            href="{{ $value->saleNote->report_sale_note ?? '#' }}"
                                                            data-te-dropdown-item-ref>Descargar nota</a>
                                                    </li>
                                                @else
                                                    <li></li>
                                        @endif

                                        </ul>
            </div>
            </td>
            </tr>
            @endforeach
        @else
            @endif

            </tbody>
            </table>
        </div>
        {{ $orders->links() }}
</div>
</section>
