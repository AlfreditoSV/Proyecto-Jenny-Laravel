<section class="bg-gray-50 py-5 ">
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
                                placeholder="Buscar productos" required="">
                        </div>
                    </div>

                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <div wire:loading.class.remove="hidden"
                        class="inline-block h-8 w-8 animate-[spinner-grow_0.75s_linear_infinite] rounded-full bg-current align-[-0.125em] text-info opacity-0 motion-reduce:animate-[spinner-grow_1.5s_linear_infinite] hidden"
                        role="status">
                    </div>
                    <button type="button"data-te-toggle="modal"
                    data-te-target="#alta_usuarios" data-te-ripple-init data-te-ripple-colsor="light" id="createOrder"
                        class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                        Alta de usuarios
                    </button>
                    <div class="flex items-center space-x-3 w-full md:w-auto">

                        <div class="relative" data-te-dropdown-ref>
                            <button wire:loading.remove wire:target="updateTable,file"
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
                                        href="#" wire:click="updateTable" data-te-dropdown-item-ref>Alta de usuarios</a>
                                </li>
                                <li>
                                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                        href="{{ route('products.export') }}" data-te-dropdown-item-ref>Descargar
                                        lista de usuarios</a>
                                </li>
                                <li>
                                    <input type="file" wire:model="file" id="excel_file" class="hidden"
                                        accept=".xlsx">
                                    <label
                                        class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                        for="excel_file" data-te-dropdown-item-ref>Cargar
                                        lista usaurios</label>
                                </li>
                                <li>
                                    <a class="cursor-pointer block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600" data-te-dropdown-item-ref
                                        data-te-toggle="modal" data-te-target="#rightBottomModal" data-te-ripple-init
                                        >Ayuda</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
     
        <div class="grid grid-flow-row-dense md:grid-cols-2 md:place-items-center md:mb-5">
            <div class="w-auto w-full py-5 md:py-0">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Observación</label>
                <textarea id="observation" rows="1"
                    class="resize-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Nota de observacion"></textarea>
            </div>
            <div class="w-auto md:mt-5">
                <div class="relative" id="datepicker-disable-past" data-te-input-wrapper-init>
                    <input type="text"
                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        placeholder="Select a date" />
                    <label for="floatingInput"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Fecha
                        de entrega</label>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto ">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <input type="checkbox" id="selectAll"
                                class="form-checkbox relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]">
                        </th>
                        <th wire:click="orderTable('id')" scope="col" class="cursor-pointer px-4 py-3">ID
                        </th>
                        <th wire:click="orderTable('name')" scope="col"
                            class="cursor-pointer px-4 py-3">Nombre</th>
                        <th wire:click="orderTable('last_name_user')" scope="col"
                            class="cursor-pointer px-4 py-3">Apellido</th>
                            <th wire:click="orderTable('id_company')" scope="col"
                            class="cursor-pointer px-4 py-3">Rol</th>
                            
                        <th wire:click="orderTable('email')" scope="col"
                            class="cursor-pointer px-4 py-3">Correo</th>
                        <th wire:click="orderTable('price_sinube_with_vat')" scope="col"
                            class="cursor-pointer px-4 py-3">Tipo de persona</th>
                        <th wire:click="orderTable('asset')" scope="col"
                            class="cursor-pointer px-4 py-3">Estado</th>
                        <th scope="col" class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($users))
                        @foreach ($users as $user => $value)
                            <tr class="border-b text-center">
                                <td class="px-6 py-3"><input type="checkbox" 
                                        value="{{ $value->id }}"
                                        class="rowCheckbox relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]">
                                </td>
                                <td class="px-4 py-3">{{ $value->id }}</td>
                                <td class="px-4 py-3">{{ $value->name }}</td>
                                <td class="px-4 py-3">{{ $value->last_name_user }}</td>
                                <td class="px-4 py-3">
                                    @switch($value->id_catalog_rol)
                                        @case(1)
                                        <span
                                        class="inline-block whitespace-nowrap rounded-full bg-primary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-primary-700">
                                        Administrador
                                      </span>
                                            @break
                                          </span>
                                        @default
                                            

                                        <span
                                        class="inline-block whitespace-nowrap rounded-full bg-primary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-primary-700">
                                        Cliente
                                    @endswitch
                                    
                                </td>
                                <td class="px-4 py-3">{{ $value->email }}</td>
                                <td class="px-4 py-3">{{ $value->person_type_user }}</td>
                                <td class="px-4 py-3">{{ $value->asset }}</td>
                                <td class="px-2 py-3">
                                    <div class="relative" data-te-dropdown-ref>
                                        <button
                                          class="flex items-center whitespace-nowrap rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] motion-reduce:transition-none"
                                          type="button"
                                          id="dropdownMenuButton5"
                                          data-te-dropdown-toggle-ref
                                          aria-expanded="false"
                                          data-te-ripple-init
                                          data-te-ripple-color="light">
                                          Acciones
                                          <span class="ml-2 w-2">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                              class="h-5 w-5">
                                              <path
                                                fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                clip-rule="evenodd" />
                                            </svg>
                                          </span>
                                        </button>
                                        <ul
                                          class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                                          aria-labelledby="dropdownMenuButton5"
                                          data-te-dropdown-menu-ref>
                                          <li>
                                            <a
                                              class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                              href="#"
                                              data-te-dropdown-item-ref
                                              >Actualizar</a
                                            >
                                          </li>
                                          <li>
                                            <a
                                              class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                              href="#"
                                              data-te-dropdown-item-ref
                                              >Desactivar</a
                                            >
                                          </li>
                                          <li>
                                            <a
                                              class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                              href="#"
                                              data-te-dropdown-item-ref
                                              >Eliminar</a
                                            >
                                          </li>
                                        </ul>
                                      </div>
                                </td>
                            </tr>
                        @endforeach

                    @endif

                </tbody>
            </table>
        </div>
       @if (!empty($users->Pages))
            {{ $users->links() }}
        @endif
</div>

<!-- Modal -->
<div
data-te-modal-init
class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
id="alta_usuarios"
tabindex="-1"
aria-labelledby="rightBottomModalLabel"
aria-hidden="true">
<div
  data-te-modal-dialog-ref
  class="pointer-events-none absolute bottom-7 right-7 h-auto w-full translate-x-[100%] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
  <div
    class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
    <div
      class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
      <!--Modal title-->
      <h5
        class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
        id="exampleModalLabel">
        Alta de usuarios
      </h5>
      <!--Close button-->
      <button
        type="button"
        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
        data-te-modal-dismiss
        aria-label="Close">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="h-6 w-6">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!--Modal body-->
    <div class="relative flex-auto p-4 text-sm" data-te-modal-body-ref>
        <div class="bg-white rounded shadow-lg p-6 max-w-md w-full max-h-96 overflow-y-auto">
               <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div x-data="data()">
        <form x-on:submit.prevent="enviarFormulario">
            @csrf

            <div class="grid gap-6">
                <!-- Name -->
                <div class="space-y-2">
                    <x-label for="name" :value="__('Nombre')" />
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="name" class="block w-full" type="text" name="name" :value="old('name')"
                            required autofocus placeholder="{{ __('Nombre') }}"  x-model="formData.name" />
                    </x-input-with-icon-wrapper>
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-label for="email" :value="__('Correo electrónico')" />
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-input withicon id="rol" class="block w-full" type="email" name="email"
                            :value="old('email')" required placeholder="{{ __('Correo electrónico') }}" x-model="formData.email" />
                    </x-input-with-icon-wrapper>
                </div>
                
                <!-- Rol users-->
                <div class="space-y-2">
                    <x-label for="rol" :value="__('Rol del usaurio')" />
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">                            
                        </x-slot>
                        
                        <select class="block w-full" name="rol"  x-model="formData.rol">
                            <option selected>Seleccione un rol</option>
                         @foreach ($catalog_roles as $role=>$value )
                         <option value="{{$value->id_catalog_rol}}">{{$value->name_catalog_rol}}</option>
                         @endforeach
                          </select>
                    </x-input-with-icon-wrapper>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-label for="password" :value="__('Contraseña')" />
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="password" class="block w-full" type="password" name="password" required
                            autocomplete="new-password" placeholder="{{ __('Contraseña') }}" x-model="formData.password"/>
                    </x-input-with-icon-wrapper>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="password_confirmation" class="block w-full" type="password"
                            name="password_confirmation" required placeholder="{{ __('Confirmar Contraseña') }}" x-model="formData.password_confirmation"/>
                    </x-input-with-icon-wrapper>
                </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="space-y-2">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" x-model="formData.terms"/>  

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-blue-600 hover:text-blue-900 dark:hover:text-blue-400">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-blue-600 hover:text-blue-900 dark:hover:text-blue-400">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                <div>
                    <x-button class="justify-center w-full gap-2" data-te-modal-dismiss>
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Regristrar') }}</span>
                    </x-button>
                </div>

                
            </div>
        </form>
    </div>
        </div>
    </div>
  </div>
</div>
</div> <!--End Modal-->
</section>
    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                document.getElementById('excel_file').addEventListener('change', function() {
                    Livewire.emit('import');
                });
            });
        </script>
    @endpush

    <script>
        // Función para manejar el evento de selección/deselección de todos los checkbox
        const selectAllCheckbox = document.querySelector("#selectAll");
        selectAllCheckbox.addEventListener("change", function() {
            const rowCheckboxes = document.querySelectorAll(".rowCheckbox");
            rowCheckboxes.forEach((checkbox) => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        const createOrderButton = document.querySelector("#createOrder");
        createOrderButton.addEventListener("click", function() {
            const orderData = [];
            const observation = document.querySelector("#observation").value;
            const selectedCheckboxes = document.querySelectorAll(
                ".rowCheckbox:checked"
            );
            if (observation != '') {
                orderData.push({
                    observation: observation,
                });
            }
            selectedCheckboxes.forEach((checkbox) => {
                const row = checkbox.closest("tr");
                const id = row.querySelector("td:nth-child(5)").textContent;
                const cantidadProductos = row.querySelector(".cantidadProductos").value;
                const cantidadExcedente = row.querySelector(".cantidadExcedente").value;
                orderData.push({
                    id: id,
                    cantidadProductos: cantidadProductos,
                    cantidadExcedente: cantidadExcedente,
                });
            });
            // Agregar un objeto vacío para que el último elemento no tenga coma
            const orderJSON = JSON.stringify(orderData);
            Livewire.emit('orderDataSubmitted', orderJSON);
        });
    </script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    
<script>
    function data(){
      return{
       formData:{
              name:'',
              email:'',
              password:'',
              password_confirmation:'',
              rol:'',
              terms:''
              },
          async enviarFormulario(){
              this.$wire.createUser(this.formData);
              this.$wire.on('createUser',(value)=>{
                if(value.icon=='success'){
                }

              })
          }
      }
    }
 </script>

   

