<div class="w-full">
    <template x-for="(odc, indexODC) in row.odcs" :key="indexODC">
        <div class="w-full bg-slate-100 shadow-lg p-2 px-4 mb-3 border last:mb-0 rounded-lg hover:shadow">
            <div class="grid grid-cols-2 items-center ">
                <div class="flex items-center space-x-3">
                    <svg x-on:dblclick="removeOutputPortODC(row, indexODC)" class="w-5 h-5 cursor-pointer fill-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>

                    <div x-text="odc.name"></div>
                </div>

                <div class="flex items-center justify-end">
                    <svg x-on:click="toggle(odc, indexODC)" x-show="!odc.show" class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                    </svg>

                    <svg x-on:click="toggle(odc, indexODC)" x-show="odc.show" class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7"></path>
                    </svg>
                </div>
            </div>

            <div class="mt-2 p-5 rounded-lg border w-full" x-show="odc.show">
                <div class="grid grid-rows-3 mb-3 w-full space-x-3">
                    <div class="grid grid-cols-2 gap-3">

                        <div class="w-full">
                            <label>Nama</label>
                            <input class="form" placeholder="Tube #1" type="text" x-model="odc.name">
                        </div>

                        <div class="w-full">
                            <label>Port Yang Dipakai</label>
                            <select class="form" x-model="odc.port">
                                <template x-for="port in row.attached.ports" :key="port.id">
                                    <option :value="port.id" x-text="row.attached.name + ' - ' + port.name" :disabled="!port.status"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-3 mb-3">

                        <div class="w-full">
                            <label for="weight">Lebar</label>
                            <input class="form" id="weight" step="2" value="20" type="number" x-model="odc.weight">
                        </div>

                        <div class="w-full">
                            <label for="opacity">Opacity</label>
                            <input class="form" id="opacity" value="0.7" step="0.1" max="1" min="0.1" type="number" x-model="odc.opacity">
                        </div>

                        <div class="w-full">
                            <label for="color">Warna</label>
                            <input class="form h-[42px] p-1" id="color" type="color" x-model="odc.color">
                        </div>
                    </div>

                    <div class="">
                        <label for="email">Deskripsi</label>
                        <textarea class="form" id="email" rows="3" x-model="odc.description"></textarea>
                    </div>

                    <div class="">
                        @include('network.inc.odcToJc_line')
                    </div>
                </div>
            </div>
        </div>
    </template>

</div>
