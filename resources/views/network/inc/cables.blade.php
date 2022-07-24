<div class="w-full">
    <div class="flex justify-end mb-3 space-x-3">
        <button type="button" x-on:click="addCable"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
            </svg>
            TAMBAH KABEL INTI
        </button>
    </div>

    <template x-for="(cable, indexCable) in cables" :key="indexCable">
        <div class="w-full bg-white shadow-lg p-2 px-4 mb-3 border last:mb-0 rounded-lg hover:shadow">
            <div class="grid grid-cols-2 items-center ">
                <div class="flex items-center space-x-3">
                    <svg x-on:dblclick="removeCable(indexCable)" class="w-5 h-5 cursor-pointer fill-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>

                    <div x-text="cable.name"></div>
                </div>

                <div class="flex items-center justify-end">
                    <svg x-on:click="toggle(cable, indexCable)" x-show="!cable.show" class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                    </svg>

                    <svg x-on:click="toggle(cable, indexCable)" x-show="cable.show" class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7"></path>
                    </svg>
                </div>
            </div>

            <div class="mt-2 p-5 rounded-lg border w-full" x-show="cable.show">
                <div class="flex flex-cable mb-3 w-full space-x-3">

                    <div class="w-full mb-3">
                        <label for="name">Nama</label>
                        <input class="form" id="name" placeholder="Tube #1" type="text" x-model="cable.name">
                    </div>

                    <div class="flex w-full space-x-3 mb-3">

                        <div class="w-2/6">
                            <label for="weight">Lebar</label>
                            <input class="form" id="weight" step="2" value="20" type="number" x-model="cable.weight">
                        </div>

                        <div class="w-2/6">
                            <label for="opacity">Opacity</label>
                            <input class="form" id="opacity" value="0.7" step="0.1" max="1" min="0.1" type="number" x-model="cable.opacity">
                        </div>

                        <div class="w-2/6">
                            <label for="color">Warna</label>
                            <input class="form h-[42px] p-1" id="color" type="color" x-model="cable.color">
                        </div>
                    </div>
                </div>

                <div class="">
                    <label for="email">Deskripsi</label>
                    <textarea class="form" id="email" rows="3" x-model="cable.description"></textarea>
                </div>

                <div class="">
                    @include('network.inc.cable_line')
                </div>
            </div>
        </div>
    </template>

</div>
