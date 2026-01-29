$(function () {

    const $mapEl = $('#map');
    if (!$mapEl.length) return;

    const pickup = [
        parseFloat($mapEl.data('pickup-lat')),
        parseFloat($mapEl.data('pickup-lng'))
    ];

    const destination = [
        parseFloat($mapEl.data('destination-lat')),
        parseFloat($mapEl.data('destination-lng'))
    ];

    /* -------------------------
       Distance calculation
    -------------------------- */
    function toRad(value) {
        return value * Math.PI / 180;
    }

    function calculateDistanceKm(lat1, lon1, lat2, lon2) {
        const R = 6371;
        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);

        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    const distanceKm = calculateDistanceKm(
        pickup[0], pickup[1],
        destination[0], destination[1]
    );

    const avgSpeed = 30; // km/h
    const etaMinutes = Math.round((distanceKm / avgSpeed) * 60);

    /* -------------------------
       MAP INITIALIZATION
    -------------------------- */
    const map = L.map('map', {
        zoomControl: false   // we’ll add it manually
    }).setView(pickup, 13);

    // Zoom controls (top-right)
    L.control.zoom({
        position: 'topright'
    }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    /* -------------------------
       CUSTOM ICONS
    -------------------------- */
    const pickupIcon = L.icon({
        iconUrl: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -28]
    });

    const dropoffIcon = L.icon({
        iconUrl: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -28]
    });

    /* -------------------------
       PICKUP & DROP-OFF MARKERS
    -------------------------- */
    L.marker(pickup, { icon: pickupIcon })
        .addTo(map)
        .bindPopup('Pickup Location');

    L.marker(destination, { icon: dropoffIcon })
        .addTo(map)
        .bindPopup('Drop-off Location');

    /* -------------------------
       OPTIONAL ROUTE LINE
    -------------------------- */
    const route = L.polyline([pickup, destination], {
        color: '#2563eb', // Tailwind blue-600
        weight: 4
    }).addTo(map);

    map.fitBounds(route.getBounds());

    /* -------------------------
       DISTANCE + ETA OVERLAY
    -------------------------- */
    const infoBox = L.control({ position: 'bottomleft' });

    infoBox.onAdd = function () {
        const div = L.DomUtil.create('div', 'map-info-box');
        div.innerHTML = `
            <div style="
                background: white;
                padding: 8px 12px;
                border-radius: 6px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.2);
                font-size: 13px;
            ">
                <strong>Distance:</strong> ${distanceKm.toFixed(2)} km<br>
                <strong>ETA:</strong> ${etaMinutes} min
            </div>
        `;
        return div;
    };

    infoBox.addTo(map);

});
