@push('javascript')
    @vite([
    	'resources/js/dashboard/index.js',
    ])
@endpush

<x-app>

    <div class="bg-white rounded-lg ring-1 p-5 h-full">
        <div id="map" class="rounded-md h-full"></div>
    </div>
</x-app>
