document.addEventListener('DOMContentLoaded', function() {
    const mapElement = document.getElementById('indonesiaMap');
    if (!mapElement || typeof L === 'undefined') return;

    const map = L.map('indonesiaMap').setView([-2.5, 118], 5);
    const locateMeBtn = document.getElementById('locateMeBtn');
    const locationStatus = document.getElementById('locationStatus');
    let myLocationMarker = null;
    let myAccuracyCircle = null;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const activeIcon = L.divIcon({
        className: 'premium-marker active',
        html: '<div class="marker-pulse"></div><div class="marker-dot"></div>',
        iconSize: [20, 20],
        iconAnchor: [10, 10]
    });

    const myLocationIcon = L.divIcon({
        className: 'my-location-marker',
        html: '<div class="my-location-pulse"></div><div class="my-location-dot"></div>',
        iconSize: [36, 36],
        iconAnchor: [18, 18]
    });

    const dashboardData = window.NusantaraUserDashboardData || {};
    const backendDestinations = toArray(dashboardData.destinations);
    const destinationUrlTemplate = dashboardData.destinationUrlTemplate || '#';
    const destinationCoordinateFallbacks = {
        'raja-ampat': { lat: -0.2309, lng: 130.5239 },
        'candi-borobudur': { lat: -7.6079, lng: 110.2038 },
        borobudur: { lat: -7.6079, lng: 110.2038 },
        'taman-nasional-komodo': { lat: -8.5455, lng: 119.4892 },
        komodo: { lat: -8.5455, lng: 119.4892 },
        'gunung-bromo': { lat: -7.9425, lng: 112.9531 },
        bromo: { lat: -7.9425, lng: 112.9531 },
        'danau-toba': { lat: 2.6845, lng: 98.8756 },
        'nusa-dua-beach': { lat: -8.7940, lng: 115.2308 },
        'nusa-dua': { lat: -8.7940, lng: 115.2308 },
        bunaken: { lat: 1.6174, lng: 124.7631 },
        'tanjung-puting': { lat: -2.8456, lng: 111.6929 }
    };

    function toArray(value) {
        if (!value) return [];
        if (Array.isArray(value)) return value;
        if (Array.isArray(value.data)) return value.data;
        return Object.values(value).filter(item => item && typeof item === 'object');
    }

    function escapeHtml(value) {
        return String(value ?? '-').replace(/[&<>"']/g, function(char) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[char];
        });
    }

    function toCoordinate(value) {
        if (value === null || value === undefined || value === '') return null;
        const number = Number(String(value).replace(',', '.'));
        return Number.isFinite(number) ? number : null;
    }

    function normalizeKey(value) {
        return String(value || '')
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    function getDestinationCoordinates(destination) {
        const latitude = toCoordinate(destination.latitude);
        const longitude = toCoordinate(destination.longitude);

        if (Number.isFinite(latitude) && Number.isFinite(longitude)) {
            return { lat: latitude, lng: longitude };
        }

        return destinationCoordinateFallbacks[normalizeKey(destination.slug)]
            || destinationCoordinateFallbacks[normalizeKey(destination.name)]
            || null;
    }

    function formatDestinationLocation(location, provinceName) {
        const cleanLocation = String(location || '').trim();
        const cleanProvince = String(provinceName || '').trim();

        if (!cleanLocation) return cleanProvince || 'Indonesia';
        if (!cleanProvince || cleanLocation.toLowerCase().includes(cleanProvince.toLowerCase())) {
            return cleanLocation;
        }

        return `${cleanLocation}, ${cleanProvince}`;
    }

    function setLocationStatus(message, type) {
        if (!locationStatus) return;

        locationStatus.textContent = message;
        locationStatus.classList.toggle('d-none', !message);
        locationStatus.classList.remove('text-muted', 'text-success', 'text-danger', 'text-warning');
        locationStatus.classList.add(type || 'text-muted');
    }

    function setLocateLoading(isLoading) {
        if (!locateMeBtn) return;

        locateMeBtn.disabled = isLoading;
        locateMeBtn.innerHTML = isLoading
            ? '<span class="spinner-border spinner-border-sm me-1" aria-hidden="true"></span>Mencari...'
            : '<i class="bi bi-crosshair me-1"></i>Lokasi Saya';
    }

    function showMyLocation(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        const accuracy = Math.round(position.coords.accuracy || 0);
        const latLng = [lat, lng];

        if (myLocationMarker) {
            myLocationMarker.setLatLng(latLng);
        } else {
            myLocationMarker = L.marker(latLng, { icon: myLocationIcon }).addTo(map);
        }

        myLocationMarker.bindPopup(`
            <div style="min-width: 190px; padding: 4px;">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-crosshair me-1"></i>Lokasi Saya</h6>
                <small class="text-muted d-block mb-2">Koordinat ini hanya tampil di browser Anda.</small>
                <span class="badge bg-primary rounded-pill">Akurasi ±${accuracy.toLocaleString('id-ID')} m</span>
            </div>
        `, { className: 'premium-popup', autoPan: false });

        if (myAccuracyCircle) {
            myAccuracyCircle.setLatLng(latLng);
            myAccuracyCircle.setRadius(accuracy);
        } else {
            myAccuracyCircle = L.circle(latLng, {
                radius: accuracy,
                color: '#0d6efd',
                weight: 1,
                fillColor: '#0d6efd',
                fillOpacity: 0.12
            }).addTo(map);
        }

        map.flyTo(latLng, Math.max(map.getZoom(), 13), { animate: true, duration: 0.7 });
        setTimeout(function() {
            myLocationMarker.openPopup();
        }, 760);

        setLocationStatus('', 'text-success');
        setLocateLoading(false);
    }

    function handleLocationError(error) {
        let message = 'Lokasi tidak bisa diambil. Coba aktifkan izin lokasi browser.';

        if (error && error.code === error.PERMISSION_DENIED) {
            message = 'Izin lokasi ditolak. Aktifkan permission lokasi untuk melihat posisi Anda.';
        } else if (error && error.code === error.TIMEOUT) {
            message = 'Pencarian lokasi terlalu lama. Coba lagi beberapa saat.';
        } else if (error && error.code === error.POSITION_UNAVAILABLE) {
            message = 'Lokasi belum tersedia dari perangkat Anda.';
        }

        setLocationStatus(message, 'text-danger');
        setLocateLoading(false);
    }

    function locateUser() {
        if (!navigator.geolocation) {
            setLocationStatus('Browser ini belum mendukung fitur lokasi.', 'text-warning');
            return;
        }

        setLocationStatus('', 'text-muted');
        setLocateLoading(true);

        navigator.geolocation.getCurrentPosition(showMyLocation, handleLocationError, {
            enableHighAccuracy: true,
            timeout: 12000,
            maximumAge: 60000
        });
    }

    const destinationMarkers = [];

    backendDestinations.forEach(function(destination) {
        const coordinates = getDestinationCoordinates(destination);
        if (!coordinates) return;

        const provinceName = destination.province && destination.province.name ? destination.province.name : 'Indonesia';
        const locationText = formatDestinationLocation(destination.location, provinceName);
        const priceText = new Intl.NumberFormat('id-ID').format(destination.price || 0);
        const destinationUrl = destinationUrlTemplate.replace('__DESTINATION_ID__', destination.id);
        const marker = L.marker([coordinates.lat, coordinates.lng], { icon: activeIcon }).addTo(map);

        const popupContent = `
            <div style="min-width: 200px; padding: 5px;">
                <h6 style="margin-bottom: 5px; font-weight: 700;">${escapeHtml(destination.name)}</h6>
                <p style="font-size: 0.75rem; color: #666; margin-bottom: 10px;">${escapeHtml(locationText)}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span style="font-weight: 800; color: #198754;">Rp ${priceText}</span>
                    <a href="${destinationUrl}" class="btn btn-sm btn-success py-1 px-2 text-white text-decoration-none" style="font-size: 0.65rem;">Explore</a>
                </div>
            </div>
        `;

        marker.bindPopup(popupContent, { className: 'premium-popup' });
        destinationMarkers.push(marker);
    });

    if (destinationMarkers.length > 0) {
        const destinationBounds = L.latLngBounds(destinationMarkers.map(function(marker) {
            return marker.getLatLng();
        }));
        map.fitBounds(destinationBounds, { padding: [45, 45] });
    }

    if (locateMeBtn) locateMeBtn.addEventListener('click', locateUser);

    setTimeout(function() {
        map.invalidateSize();
    }, 800);
});
