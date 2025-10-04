@props(['country', 'planTitle' => ''])

<div
    class="map-container bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden w-full">
    <div
        class="map-header relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white p-4 overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-2 left-2 w-16 h-16 bg-white rounded-full blur-sm"></div>
            <div class="absolute bottom-2 right-2 w-20 h-20 bg-white rounded-full blur-sm"></div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-white rounded-full blur-md">
            </div>
        </div>

        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-white bg-opacity-20 rounded-full p-2 backdrop-blur-sm">
                    <i class="fas fa-map-marked-alt text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-lg">{{ $country->name }}</h3>
                    <p class="text-sm opacity-80 flex items-center">
                        <i class="fas fa-globe mr-1"></i>
                        {{ $country->region ?? 'Unknown Region' }}
                    </p>
                </div>
            </div>
            @if($planTitle)
            <div class="bg-white bg-opacity-20 rounded-lg px-3 py-1 backdrop-blur-sm">
                <span class="text-sm font-medium truncate max-w-48">{{ $planTitle }}</span>
            </div>
            @endif
        </div>
    </div>

    <div class="map-content relative" style="height: 250px; min-height: 250px;">
        <!-- OpenStreetMap with Leaflet -->
        <div id="map-{{ $country->id }}" class="w-full h-full rounded-lg overflow-hidden"></div>

        <!-- Map overlay information -->
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-3 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="bg-white/20 rounded-full p-1 backdrop-blur-sm">
                        <i class="fas fa-map-marker-alt text-sm"></i>
                    </div>
                    <span class="text-sm font-medium">{{ $country->name }} - Travel Destination</span>
                </div>
                <div class="flex items-center space-x-1 text-xs opacity-80">
                    <i class="fas fa-layer-group"></i>
                    <span>OpenStreetMap</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for OpenStreetMap with Leaflet -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get country coordinates
        const coordinates = @json($country -> coordinates);
        const countryName = '{{ $country->name }}';
        const countryRegion = '{{ $country->region }}';
        const countryCode = '{{ $country->code }}';
        const planTitle = '{{ $planTitle }}';

        // Initialize map
        const mapId = 'map-{{ $country->id }}';
        const map = L.map(mapId).setView(coordinates, 3);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        // Create custom icon with animation
        const travelIcon = L.divIcon({
            className: 'travel-marker',
            html: `
                <div class="travel-marker-container relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500 to-pink-600 rounded-full animate-ping opacity-75"></div>
                    <div class="relative bg-gradient-to-br from-red-500 to-pink-600 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-2xl">
                        <i class="fas fa-plane text-lg"></i>
                    </div>
                    <div class="absolute -top-1 -right-1 bg-yellow-400 text-yellow-900 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold shadow-lg animate-bounce">
                        ✈
                    </div>
                </div>
            `,
            iconSize: [48, 48],
            iconAnchor: [24, 48],
            popupAnchor: [0, -48]
        });

        // Add marker without popup
        const marker = L.marker(coordinates, { icon: travelIcon }).addTo(map);

        // Add click event to marker
        marker.on('click', function () {
            console.log(`Travel destination clicked: ${countryName}`);
            // You can add more functionality here, like opening a modal or navigating to a detail page
        });

        // Add map click event
        map.on('click', function (e) {
            console.log(`Map clicked at coordinates: ${e.latlng.lat}, ${e.latlng.lng}`);
        });

        // Fit map to marker with some padding
        map.fitBounds(marker.getLatLng(), { padding: [20, 20] });

        // Add zoom controls
        const zoomControl = L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        // Add custom controls with modern design
        const customControl = L.control({ position: 'topright' });
        customControl.onAdd = function (map) {
            const div = L.DomUtil.create('div', 'custom-control bg-white/90 backdrop-blur-md rounded-xl shadow-2xl p-2 border border-white/20');
            div.innerHTML = `
                <button onclick="toggleMapView('${countryName}')" 
                        class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-lg p-2 mb-2 w-full shadow-lg"
                        title="Expand map">
                    <i class="fas fa-expand text-sm"></i>
                </button>
                <button onclick="centerMap('${mapId}')" 
                        class="bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white rounded-lg p-2 w-full shadow-lg"
                        title="Center map">
                    <i class="fas fa-crosshairs text-sm"></i>
                </button>
            `;
            return div;
        };
        customControl.addTo(map);

        // Store map reference globally for external functions
        window.travelMaps = window.travelMaps || {};
        window.travelMaps[mapId] = map;
    });

    // External functions
    function toggleMapView(countryName) {
        alert(`Map expansion feature is under development.\nDestination: ${countryName}`);
    }

    function zoomIn(mapId = null) {
        if (mapId && window.travelMaps[mapId]) {
            window.travelMaps[mapId].zoomIn();
        }
    }

    function zoomOut(mapId = null) {
        if (mapId && window.travelMaps[mapId]) {
            window.travelMaps[mapId].zoomOut();
        }
    }

    function centerMap(mapId) {
        if (mapId && window.travelMaps[mapId]) {
            const map = window.travelMaps[mapId];
            const coordinates = @json($country -> coordinates);
            map.setView(coordinates, 3);
        }
    }
</script>

<style>
    .map-container {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        background-size: 400% 400%;
        animation: gradientShift 8s ease infinite;
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .map-container:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .map-content {
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .map-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .map-content:hover::before {
        left: 100%;
    }

    /* Leaflet map styles */
    .travel-marker {
        background: transparent !important;
        border: none !important;
    }

    .travel-marker-container {
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
    }

    /* Custom control styles */
    .custom-control {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }

    .custom-control button {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .custom-control button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .custom-control button:hover::before {
        left: 100%;
    }

    /* Leaflet popup customization */
    .leaflet-popup-content-wrapper {
        border-radius: 16px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        animation: popupSlideIn 0.3s ease-out;
    }

    @keyframes popupSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .leaflet-popup-content {
        margin: 0;
        line-height: 1.6;
    }

    .leaflet-popup-tip {
        background: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.4);
    }

    /* Zoom control customization */
    .leaflet-control-zoom a {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #374151;
        transition: all 0.3s ease;
    }

    .leaflet-control-zoom a:hover {
        background: rgba(255, 255, 255, 1);
        transform: scale(1.1);
    }

    /* Additional animations */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .travel-marker-container {
        animation: float 3s ease-in-out infinite;
    }

    /* Large screen optimization - Single column layout */
    @media (min-width: 1440px) {
        .map-container .map-content {
            height: 450px;
        }

        .map-container {
            width: 100%;
            max-width: 100%;
        }
    }

    @media (min-width: 1200px) and (max-width: 1439px) {
        .map-container .map-content {
            height: 400px;
        }

        .map-container {
            width: 100%;
            max-width: 100%;
        }
    }

    @media (min-width: 1024px) and (max-width: 1199px) {
        .map-container .map-content {
            height: 350px;
        }

        .map-container {
            width: 100%;
            max-width: 100%;
        }
    }

    /* Medium screen */
    @media (max-width: 1023px) {
        .map-container .map-content {
            height: 250px;
        }

        .map-container {
            width: 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .map-container .map-content {
            height: 200px;
        }

        .map-header span {
            max-width: 120px;
        }

        .map-header .text-sm {
            display: none;
        }

        .custom-control {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .map-container .map-content {
            height: 180px;
        }

        .map-header {
            padding: 8px 12px;
        }

        .map-header .text-sm {
            display: none;
        }

        .custom-control {
            display: none;
        }
    }
</style>