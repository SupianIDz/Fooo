@push('javascript')
    @vite([
    	'resources/js/dashboard/index.js',
    ])
@endpush

<x-app>
    <div id="map" class="h-full"></div>
</x-app>
