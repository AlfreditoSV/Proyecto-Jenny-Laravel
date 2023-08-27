<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de productos') }}
        </h2>
    </x-slot>
    <div class=" bg-white rounded-md shadow-md lg:flex-row md:justify-between dark:bg-dark-eval-1">
        @livewire('products.products-list')
    </div>
    <div
data-te-modal-init
class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
id="rightBottomModal"
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
        Levantar una orden
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
            
                <h1 class="text-2xl font-semibold mb-4">¡Bienvenido al Administrador de Órdenes de Productos!</h1>
                <p class="text-gray-600 mb-6">Aquí puedes crear una nueva orden de productos de manera personalizada. Te ofrecemos dos opciones para armar tu orden:</p>
        
                <h2 class="text-xl font-semibold mb-2">Opción 1: Crear una Orden Completa</h2>
                <ul class="list-disc ml-6 mb-4">
                    
                    <li>Preciona el check para seleccionar todos los productos</li>
                    <li>Las cantidades y excedentes deberás ingresarlas manualmente para cada producto.</li>
                    <li>Simplemente haz clic en el botón "Levantar orden".</li>
                </ul>
        
                <h2 class="text-xl font-semibold mb-2">Opción 2: Seleccionar Productos Personalizados</h2>
                <ul class="list-disc ml-6 mb-4">
                    <li>Explora la lista de productos disponibles en la tabla de lista de productos</li>
                    <li>Utiliza el buscador para encontrar un producto específico, si es necesario.</li>
                    <li>Marca las casillas de verificación de los productos que deseas incluir en tu orden.</li>
                    <li>Ingresa las cantidades y excedentes deseados para cada producto en las columnas correspondientes.</li>
                    <li>Simplemente haz clic en el botón "Levantar orden".</li>
                    <br>

                    <li><strong>Opción Extra:</strong> Si prefieres, puedes descargar la lista de productos en formato Excel.</li>
                    <li>Luego, en la columna "Cantidades" y "Excedentes", actualiza los valores y guarda el archivo.</li>
                    <li>Finalmente, sube el archivo con tus cantidades y excedentes actualizados utilizando el botón "Cargar lista productos".</li>
                </ul>
        
                <p class="text-gray-600 mb-4">Recuerda que esta opción te permite gestionar órdenes de manera más eficiente, especialmente si tienes muchas cantidades que ingresar.</p>
        
                <p class="text-gray-600 mb-4">Estamos aquí para brindarte asistencia en todo el proceso. Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>
        
                <p class="text-gray-600">¡Esperamos que esta herramienta facilite tu experiencia al crear órdenes de productos a medida de una manera más conveniente!</p>
           
        </div>
    </div>
  </div>
</div>
</div>
    <script src="{{asset('assets/js/app.js')}}"></script>
</x-app-layout>


