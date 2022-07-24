<div class="w-full">
    <template x-for="(rowJC, indexJC) in odcLinesWithJCPorts" :key="indexJC">
        <div class="w-full bg-white shadow-lg p-2 px-4 mb-3 border last:mb-0 rounded-lg hover:shadow">
            <div class="grid grid-cols-2 items-center ">
                <div class="flex items-center space-x-3">
                    <div x-html="'<span class=\'text-indigo-500 font-bold\'>' + rowJC.attached.name + '</span> ' + rowJC.name"></div>
                </div>

                <div class="flex items-center justify-end">
                    <svg x-on:click="toggle(rowJC, indexJC)" x-show="!rowJC.show" class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                    </svg>

                    <svg x-on:click="toggle(rowJC, indexJC)" x-show="rowJC.show" class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7"></path>
                    </svg>
                </div>
            </div>

            <div class="mt-2 p-5 rounded-lg border w-full" x-show="rowJC.show">
                <div class="flex justify-end mb-3 space-x-3">
                    <button type="button" x-on:click="addOutputPortJC(rowJC)"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
                        </svg>
                        TAMBAH OUTPUT PORT JC
                    </button>
                </div>

                <div class="flex flex-row mb-3 w-full space-x-3">
                    @include('network.inc.jcToOdp_port')
                </div>
            </div>
        </div>
    </template>

</div>
