@push('javascript')
    @isset($tube)
        <script>window.uuid = '{{ $tube->uuid }}';</script>
    @endisset


    @vite([
    	'resources/js/network/create/index.js',
    ])
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

                    @if(isset($tube) && $tube->state >= 1)
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent group"
                                id="lines-tab" data-tabs-target="#cables" type="button" role="tab" aria-controls="cables" aria-selected="true">
                                <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                </svg>
                                JALUR KABEL INTI
                            </button>
                        </li>
                    @endif

                    @if(isset($tube) && $tube->state >= 2)
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent group"
                                id="odc-tab" data-tabs-target="#odc" type="button" role="tab" aria-controls="cables" aria-selected="true">
                                <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                </svg>
                                JALUR KABEL ODC
                            </button>
                        </li>
                    @endif

                    @if(isset($tube) && $tube->state >= 3)
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent group"
                                id="jc-tab" data-tabs-target="#jc" type="button" role="tab" aria-controls="cables" aria-selected="true">
                                <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                </svg>
                                JALUR KABEL JC
                            </button>
                        </li>
                    @endif

                </ul>

            </div>

            <div id="myTabContent">

                <div class="rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="detail">
                    @include('network.inc.detail')
                </div>

                <div class="hidden rounded-lg dark:bg-gray-800" id="lines" role="tabpanel" aria-labelledby="lines-tab">
                    @include('network.inc.lines')
                </div>

                @if(isset($tube) && $tube->state >= 1)
                    <div class="hidden rounded-lg dark:bg-gray-800" id="cables" role="tabpanel" aria-labelledby="cables-tab">
                        @include('network.inc.cables')
                    </div>
                @endif

                @if(isset($tube) && $tube->state >= 2)
                    <div class="hidden rounded-lg dark:bg-gray-800" id="odc" role="tabpanel" aria-labelledby="odc-tab">
                        @include('network.inc.odcToJc')
                    </div>
                @endif

                @if(isset($tube) && $tube->state >= 3)
                    <div class="hidden rounded-lg dark:bg-gray-800" id="jc" role="tabpanel" aria-labelledby="jc-tab">
                        @include('network.inc.jcToOdp')
                    </div>
                @endif
            </div>

            <div class="flex justify-end pt-5">

                <button type="button" x-on:click="{{ isset($tube) ? 'update' : 'create' }}"
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

    <div id="modalMap" tabindex="-1" aria-hidden="true" class="hidden  overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms of Service
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="modalMap">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="h-full h-[400px]" id="mapModal"></div>
                </div>
            </div>
        </div>
    </div>
</x-app>
