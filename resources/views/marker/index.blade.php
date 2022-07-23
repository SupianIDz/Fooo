@push('javascript')
    @vite([
    	'resources/js/marker/create.js',
    ])
@endpush

<x-app>
    <div class="bg-white rounded-lg ring-1 p-5" x-data="marker">
        <div class="relative overflow-x-auto sm:rounded-lg p-2 select-none">
            <div class="flex flex-row justify-between pb-4 bg-white dark:bg-gray-900">
                <div>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search"
                               class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Search for items">
                    </div>
                </div>

                <div class="">
                    <button data-modal-toggle="defaultModal"
                            class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden outline-none  text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-0 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        TAMBAH
                    </span>
                    </button>
                </div>
            </div>

            <table class="w-full mb-3 border text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gradient-to-br from-purple-600 to-blue-500 text-xs text-white uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama Marker
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Jenis Marker
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Jumlah Port
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Alamat Marker
                        </th>
                        <th scope="col" class="py-3 px-6"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($markers as $marker)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-4 w-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-1" type="checkbox"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $marker->name }}
                            </th>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <img class="w-5" src="{{ $marker->icon_url }}" alt="">
                                    <span>{{ $marker->type_alias }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                6 <small>PORT</small>
                            </td>
                            <td class="py-4 px-6">
                                {{ $marker->address }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3 justify-end">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ubah</a>
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $markers->links() }}

        </div>

        @include('marker.create')
    </div>
</x-app>
