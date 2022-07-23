@push('javascript')
    @vite([
    	'resources/js/network/create/index.js',
    ])

    <script src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select.js"></script>
@endpush

<x-app>
    <div class="bg-white p-5 rounded-lg p-5">

        <div class="flex flex-row h-60 w-full space-x-3">
            <div id="map1" class="border rounded-md w-full"></div>
        </div>

        <div class="pt-3 space-x-3 select-none" x-data="tube">

            <div class="mb-4 flex justify-between border-b border-gray-200 dark:border-gray-700">
                <ul class="flex justify-center -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent group"
                            id="detail" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <svg aria-hidden="true" class="mr-2 w-5 h-5 text-gray-400 group-hover:text-blue-500" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                            DETAIL TUBE
                        </button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent group"
                            id="lines-tab" data-tabs-target="#lines" type="button" role="tab" aria-controls="lines" aria-selected="true">
                            <svg aria-hidden="true" class="mr-2 w-5 h-5 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                            JALUR TUBE
                        </button>
                    </li>
                </ul>

            </div>

            <div id="myTabContent">

                <div class="rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="detail">
                    @include('network.inc.detail')
                </div>

                <div class="hidden rounded-lg dark:bg-gray-800" id="lines" role="tabpanel" aria-labelledby="lines-tab">
                    @include('network.inc.lines')
                </div>
            </div>

            <div class="flex justify-end pt-5">

                <button type="button" x-on:click="create"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    SIMPAN
                </button>
            </div>
        </div>
    </div>
</x-app>
