<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('SOLICITUDES DE VERIFICACION') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            

            <div class="flex justify-between mb-4">
            @livewire('nueva-verificacion')


            <div class="flex">
            <form class="flex" action="{{ route('buscar') }}" method="GET" style="margin: 15px;">
                <input type="text" placeholder="Ingresar dato" class="w-full md:w-80 px-3 h-10 rounded-l border-2 border-gray-500  focus:border-gray-500" name="query">
                <button type="submit" class="bg-gray-500 text-white rounded-r px-2 md:px-3 py-0 md:py-1 hover:bg-gray-600" type="submit">Buscar</button>
            </form>
            <div class="bg-red-500 hover:bg-red-600 text-dark font-bold py-2 px-4 rounded ml-1" style="margin: 15px 15px 15px 0px; display: {{ $filtro }}; color: black;">
                <form action="{{ route('verificaciones') }}" method="GET">
                    <button class="button" type="submit">
                        X
                    </button>
                </form>
            </div>
            </div>
            </div>
            
            <!--TABLA DE VERIFICACIONES-->

                    <table id="example" class="table table-striped" style="width:98%; text-align: center; margin: 15px 15px 15px 15px; border: 3.5px; border-style: solid;
  border-color: white;">
                        <thead class="text-s uppercase border-b bg-gray-700 rounded text-white font-bold">
                            <tr class="text-center">
                                <th scope="col" class="px-[1.2rem] py-2">N° SUMINISTRO</th>
                                <th scope="col" class="px-1 py-2">NOMBRES</th>
                                <th scope="col" class="px-1 py-2">CELULAR</th>
                                <th scope="col" class="px-1 py-2">FECHA DE CREACIÓN</th>
                                <th scope="col" class="px-1 py-2">TIPO DE VERIFICACION</th>
                                <th scope="col" class="px-1 py-2">ESTADO</th>
                                <th scope="col" class="px-1 py-2">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.7rem;">
                                @foreach ($verificaciones as $verificacion)
                                <tr id="{{ $verificacion->id }}" class="border-b border-gray-700 text-center  dark:text-white">
                                    <td class="py-2">{{ $verificacion->suministro }}</td>
                                    <td class="py-2">{{ $verificacion->nombre_completo}}</td>
                                    <td class="py-2">{{ $verificacion->celular}}</td>
                                    <td class="py-2">{{ $verificacion->created_at}}</td>
                                    <td class="py-2">{{ $verificacion->tipo}}</td>

                                    <td class="py-2">
                                        @if(date('Y-m-d')>$verificacion->fecha_fin)
                                        <label class="estados" style="background-color: red; padding: 3.5%;">PLAZO LIMITE VENCIDO</label>
                                        @else
                                            @if($verificacion->estado == "PENDIENTE DE ENTREGA")
                                            <label  class="estados" style="background-color: #077ac0; padding: 3.5%;">PENDIENTE DE INFORME</label>
                                            @else
                                            <label  class="estados" style="background-color: green; padding: 3.5%;">TRABAJO REALIZADO</label>
                                            @endif
                                        @endif

                                    </td>
                                    <td class="py-2">

                                    <div x-data="{ opendos: false }" class="inline-block text-left">
                                    <button @click="opendos = !opendos" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" style="
                                        padding: 6px;
                                        /* background-color: #a8a40b; */
                                        color: black;
                                    ">
                                        Opciones
                                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.94l3.71-3.75a.75.75 0 011.08 1.04l-4.25 4.3a.75.75 0 01-1.08 0L5.23 8.23a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <!-- Menú desplegable -->
                                    <div x-show="opendos" @click.outside="opendos = false" x-cloak class="absolute z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                        <div class="py-1" role="none">
                                        <a href="#" class=" inline-flex text-gray-700 block px-4 py-2 text-sm os" role="menuitem" tabindex="-1" id="menu-item-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                            </svg>    
                                                        . Ver Informe</a>
                                            <br>
                                                        <a href="#" class="inline-flex text-gray-700 block px-4 py-2 text-sm os" role="menuitem" tabindex="-1" id="menu-item-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16">
                                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707z"/>
                                                        </svg>
                                                        . Subir Informe</a>
                                            <br>
                                                        <a href="{{ route('generardocumento', ['id' => $verificacion->id]) }}" class="inline-flex text-gray-700 block px-4 py-2 text-sm os" role="menuitem" tabindex="-1" id="menu-item-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-word-fill" viewBox="0 0 16 16">
                                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M5.485 6.879l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 9.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 1 1 .97-.242z"/>
                                            </svg>    
                                                        . Generar Word</a>
                                            <br>
                                                        <a href="#" class="inline-flex text-gray-700 block px-4 py-2 text-sm os" role="menuitem" tabindex="-1" id="menu-item-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                            </svg>    
                                                        . Editar</a>

                                            <br>
                                                        <a href="{{ route('eliminar', ['id' => $verificacion->id]) }}" class="inline-flex text-gray-700 block px-4 py-2 text-sm os" role="menuitem" tabindex="-1" id="menu-item-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                        </svg>    . Eliminar</a>
                                            
                                        </div>
                                    </div>
                                </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>

                    <br><br><br><br><br><br><br>
                    {{ $verificaciones->links() }}
                                
            </div>
        </div>
    </div>

    

</x-app-layout>