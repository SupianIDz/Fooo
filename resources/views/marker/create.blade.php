<div id="defaultModal" tabindex="-1"
     class="select-none hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex"
     aria-modal="true" role="dialog" data-modal-show="true">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    TAMBAH MARKER
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">TUTUP</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 p-5 space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div class="w-full">
                        <label for="name">Nama</label>
                        <input class="form" id="name" type="text" x-model="detail.name">
                    </div>

                    <div class="w-full">
                        <label for="weight">Jenis</label>
                        <select class="form" x-model="detail.type" x-init="$watch('detail.type', (value) => watcher(value, detail))">
                            @foreach(['POLE' => 'TIANG', 'JC' => 'JOIN CLOSURE', 'ODC' => 'OPTICAL DISTRIBUTION CABINET', 'ODP' => 'OPTICAL DISTRIBUTION POINT'] as $index => $type)
                                <option class="uppercase" value="{{ $index }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="" x-show="detail.hasPort">
                    <label for="port">Jumlah Port</label>
                    <input class="form" id="port" type="number" x-model="detail.port">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="w-full">
                        <label for="name">Latitude</label>
                        <input class="form" id="name" type="text" x-model="detail.lat">
                    </div>

                    <div class="w-full">
                        <label for="weight">Longitude</label>
                        <input class="form" id="name" type="text" x-model="detail.lng">
                    </div>
                </div>

                <div class="">
                    <label for="email">Alamat</label>
                    <textarea class="form" id="address" rows="3" x-model="detail.address"></textarea>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                <button data-modal-toggle="defaultModal" type="button" x-on:click="create"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    SIMPAN
                </button>
                <button data-modal-toggle="defaultModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    BATAL
                </button>
            </div>
        </div>
    </div>
</div>
