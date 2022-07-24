<div class="w-full">
    <div class="flex justify-end my-3 space-x-3">
        <button type="button" x-on:click="addCableLine(cable)"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
            </svg>
            TAMBAH JALUR KABEL INTI
        </button>
    </div>

    <template x-for="(row, indexCableLine) in cable.lines" :key="indexCableLine">
        <div class="w-full bg-white shadow-lg p-2 px-4 mb-3 border last:mb-0 rounded-lg hover:shadow">
            <div class="grid grid-cols-2 items-center ">
                <div class="flex items-center space-x-3">
                    <svg x-on:dblclick="removeCableLine(cable, indexCableLine)" class="w-5 h-5 cursor-pointer fill-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>

                    <div x-text="cable.name + ' - ' + row.name"></div>
                </div>

                <div class="flex items-center justify-end">
                    <svg x-on:click="toggle(row, indexCableLine)" x-show="!row.show" class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                    </svg>

                    <svg x-on:click="toggle(row, indexCableLine)" x-show="row.show" class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7"></path>
                    </svg>
                </div>
            </div>

            <div class="mt-2 p-5 rounded-lg border w-full" x-show="row.show">
                <div class="flex flex-row mb-3 w-full space-x-3">

                    <div class="w-2/6">
                        <label>Nama</label>
                        <input class="form" placeholder="Tube #1" type="text" x-model="row.name">
                    </div>

                    <div x-show="!row.manual" class="w-3/6">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                            Kordinat Berdasarkan Marker
                        </label>
                        <select class="form" :id="'selectCore' + indexCable + '_' + indexCableLine" x-ref="selectCore"
                                x-init="$nextTick(() => initSelectCore(row, indexCable, indexCableLine))">
                            @foreach($markers as $marker)
                                <option value="{{ $marker->id }}">{{ $marker->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="row.manual" class="grid grid-cols-2 gap-3 w-3/6">
                        <div class="w-full">
                            <label :for="'latitude' + indexCableLine">Latitude</label>
                            <input class="form" :id="'latitude' + indexCable + indexCableLine" x-model="row.coordinates[0]" type="text">
                        </div>
                        <div class="w-full">
                            <label :for="'longitude' + indexCableLine">Longitude</label>
                            <input class="form" :id="'longitude' + indexCable + indexCableLine" x-model="row.coordinates[1]" type="text">
                        </div>
                    </div>

                    <div class="w-1/6 mt-9 pl-3">
                        <label :for="'default-toggle' + indexCableLine" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" value="" :id="'default-toggle' + indexCableLine" class="sr-only peer" x-model="row.manual"
                                   x-init="$watch('row.manual', () => watcher(row))">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                KOORDINAT MANUAL
                            </span>
                        </label>
                    </div>
                </div>

                <div class="">
                    <label for="email">Alamat</label>
                    <textarea class="form" id="email" rows="3" x-model="row.address"></textarea>
                </div>

                <div class="">

                </div>
            </div>
        </div>
    </template>

</div>
