<div>
{{-- If your happiness depends on money, you will never be happy with yourself. --}}


        <button wire:click="$set('open', true)" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-2" style="background-color:#077ac0; margin: 15px;">
            Nueva Verificacion
        </button>

        <x-dialog-modal wire:model="open" class="w-auto">

            <x-slot name="title">
                    VERIFICACION NUEVA
            </x-slot>

            <x-slot name="content">

                <form method="POST" action="{{ route('crear-verificacion') }}">
                @csrf
                @if ($errors->any())
                <ul class="list-none p-4 mb-4 bg-red-100 text-red-500">
                    @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
                @endif

                <div class="m-4">
                    <label for="tipo">Tipo de verificación:</label>
                    <select class="in w-full mt-2" name="tipo" id="tipo" required>
                        <option value="" disabled selected></option>
                        <option value="POR CONEXIONES DEL MEDIDOR">VERIFICACION DE LAS CONEXIONES DEL MEDIDOR</option>
                        <option value="POR RUTA ERRONEA">VERIFICACIONES DE LA RUTA DEL MEDIDOR</option>
                        <option value="POR MEDIDOR ILEGIBLE">VERIFICACION POR  ILEGIBLE</option>
                        <option value="POR CAMBIO DE TARIFA">VERIFICACION POR CAMBIO DE TARIFA</option>
                    </select>
                </div>
                <br>
                <div class="w-full flex flex-row justify-between">
                    <div class="m-4">
                        <label for="dni">DNI:</label>
                        <input type="text" class=" in w-full mt-2" name="dni" id="dni" pattern="[0-9]{8}" title="Solo se permiten números de 8 dígitos" required>
                    </div>
                    <div class="m-4">
                        <label for="suministro">Suministro:</label>
                        <input type="text" class=" in w-full mt-2" name="suministro" id="suministro" required>
                    </div>
                    <div class="m-4">
                        <label for="celular">Celular:</label>
                        <input type="text" class=" in w-full mt-2" name="celular" id="celular" required>
                    </div>
                </div>
                <br>
                <div class="m-4">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" class="in w-full mt-2 " name="nombre_completo" id="nombre_completo" required>
                </div>
                <br>
                <div class="m-4">
                    <label for="direccion">Direccion:</label>
                    <input type="text" class="in w-full mt-2" name="direccion" id="direccion" required>
                </div>
                <br>
                <div class="w-full flex flex-row justify-between">
                    <div class="m-4">
                        <label for="ruta">Ruta:</label>
                        <input type="text" class=" in w-full mt-2" name="ruta" id="ruta" required>
                    </div>
                    <div class="m-4">
                        <label for="latitud">Latitud:</label>
                        <input type="text" class=" in w-full mt-2" name="latitud" id="latitud" required>
                    </div>
                    <div class="m-4">
                        <label for="longitud">Longitud:</label>
                        <input type="text" class=" in w-full mt-2" name="longitud" id="longitud" required>
                    </div>
                </div>


                <br>


                <div class="m-1 flex justify-end">
                    <button wire:click="$set('open', false)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mx-4" style="
    background-color: #c53030;
">CANCELAR</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"  style="
    background-color: #0c92ba;
    margin-left: 5px;
">REGISTRAR</button>
                </div>
                </form>

            </x-slot>
        </x-dialog-modal>

</div>
