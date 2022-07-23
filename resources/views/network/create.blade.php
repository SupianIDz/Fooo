@push('javascript')
    @vite([
    	'resources/js/network/create/index.js',
    ])
@endpush

<x-app>
    <div class="bg-white p-5 rounded-lg p-5">

        <div class="flex flex-row h-56 w-full space-x-3">
            <div id="map1" class="border rounded-md w-1/2"></div>
            <div id="map2" class="border rounded-md w-1/2"></div>
        </div>

        <div class="pt-3 space-x-3 select-none" x-data="tube">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap justify-center -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent group"
                            id="detail" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
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
                            id="lines-tab" data-tabs-target="#lines" type="button" role="tab" aria-controls="lines" aria-selected="false">
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

                <div class="p-4 rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="detail">
                    @include('network.inc.detail')
                </div>

                <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="lines" role="tabpanel" aria-labelledby="lines-tab">
                    @include('network.inc.lines')
                </div>
            </div>

            <div class="flex justify-end">
                <button type="button" x-on:click="create"
                        class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden outline-none  text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-0 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        SIMPAN
                    </span>
                </button>
            </div>
        </div>
    </div>
</x-app>
