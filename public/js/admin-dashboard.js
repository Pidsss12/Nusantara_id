let bookingChart;
let revenueChart;
const MAP_FEED_LIMIT = 10;

function initCharts() {
    const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    const textColor = isDark ? '#94a3b8' : '#64748b';
    const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

    const bookingCanvas = document.getElementById('bookingChart');
    const revenueCanvas = document.getElementById('revenueChart');

    if (bookingCanvas) {
        const bookingCtx = bookingCanvas.getContext('2d');
        bookingChart = new Chart(bookingCtx, {
            type: 'line',
            data: {
                labels: ['Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'],
                datasets: [{
                    label: 'Bookings',
                    data: [420, 550, 680, 720, 890, 1020],
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#198754',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: textColor } },
                    y: { grid: { color: gridColor }, ticks: { color: textColor } }
                }
            }
        });
    }

    if (revenueCanvas) {
        const revenueCtx = revenueCanvas.getContext('2d');
        revenueChart = new Chart(revenueCtx, {
            type: 'doughnut',
            data: {
                labels: ['Wisata', 'Edukasi', 'Package'],
                datasets: [{
                    data: [45, 30, 25],
                    backgroundColor: ['#198754', '#f59e0b', '#6366f1'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: textColor, padding: 20, usePointStyle: true }
                    }
                }
            }
        });
    }
}

function initUserMap() {
    const mapElement = document.getElementById('indonesiaMap');
    if (!mapElement || typeof L === 'undefined') return;

    const map = L.map('indonesiaMap').setView([-2.5, 118], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    setTimeout(() => map.invalidateSize(), 200);

    function makeUserIcon(color) {
        return L.icon({
            iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${color}.png`,
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
    }

    const onlineUserIcon = makeUserIcon('green');
    const offlineUserIcon = makeUserIcon('red');
    const markerLayer = L.layerGroup().addTo(map);
    let activeMarkers = [];
    let currentUsers = [];
    const now = Date.now();

    const fallbackUsers = [
        { name: 'Rian Hidayat', email: 'rian99@gmail.com', lat: -6.2088, lng: 106.8456, status: 'Offline', city: 'Jakarta', province: 'DKI Jakarta', last_seen_at: new Date(now - 24 * 60 * 1000).toISOString() },
        { name: 'Siti Aminah', email: 'sitiaminah@gmail.com', lat: -6.9175, lng: 107.6191, status: 'Online', city: 'Bandung', province: 'Jawa Barat', last_seen_at: new Date(now - 2 * 60 * 1000).toISOString() },
        { name: 'Budi Santoso', email: 'budi.s@yahoo.com', lat: -7.0051, lng: 110.4381, status: 'Offline', city: 'Semarang', province: 'Jawa Tengah', last_seen_at: new Date(now - 42 * 60 * 1000).toISOString() },
        { name: 'Adi Wijaya', email: 'adiwijaya@gmail.com', lat: -7.2575, lng: 112.7521, status: 'Online', city: 'Surabaya', province: 'Jawa Timur', last_seen_at: new Date(now - 1 * 60 * 1000).toISOString() },
        { name: 'Gede Putra', email: 'gedeputra@gmail.com', lat: -8.4095, lng: 115.1889, status: 'Online', city: 'Denpasar', province: 'Bali', last_seen_at: new Date(now - 4 * 60 * 1000).toISOString() },
        { name: 'Eko Prasetyo', email: 'ekopras@gmail.com', lat: -0.9471, lng: 100.4172, status: 'Offline', city: 'Padang', province: 'Sumatera Barat', last_seen_at: new Date(now - 58 * 60 * 1000).toISOString() },
        { name: 'Rina Maluku', email: 'rina.m@gmail.com', lat: -3.6561, lng: 128.1906, status: 'Online', city: 'Ambon', province: 'Maluku', last_seen_at: new Date(now - 3 * 60 * 1000).toISOString() }
    ];

    let mainData = toArray(window.NusantaraUserMapData);
    if (mainData.length === 0) {
        mainData = fallbackUsers;
    }

    function toArray(value) {
        if (!value) return [];
        if (Array.isArray(value)) return value;
        if (Array.isArray(value.data)) return value.data;
        return Object.values(value).filter(item => item && typeof item === 'object');
    }

    function pick(object, keys) {
        for (let i = 0; i < keys.length; i += 1) {
            const value = keys[i].split('.').reduce((source, part) => {
                if (source && Object.prototype.hasOwnProperty.call(source, part)) {
                    return source[part];
                }
                return undefined;
            }, object);

            if (value !== undefined && value !== null && value !== '') {
                return value;
            }
        }

        return null;
    }

    function toNumber(value) {
        if (value === null || value === undefined || value === '') return null;
        const number = Number(String(value).replace(',', '.'));
        return Number.isFinite(number) ? number : null;
    }

    function escapeHtml(value) {
        return String(value ?? '-').replace(/[&<>"']/g, char => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        }[char]));
    }

    function resolveStatus(user) {
        const rawStatus = String(pick(user, ['status', 'online_status', 'activity_status', 'presence']) ?? '').trim().toLowerCase();
        const onlineValues = ['online', 'active', 'on', '1', 'true'];
        const offlineValues = ['offline', 'inactive', 'off', '0', 'false'];

        if (onlineValues.includes(rawStatus)) return 'Online';
        if (offlineValues.includes(rawStatus)) return 'Offline';

        const isOnline = pick(user, ['is_online', 'online']);
        const isOnlineValue = String(isOnline).toLowerCase();
        if (isOnline === true || isOnline === 1 || isOnlineValue === '1' || isOnlineValue === 'true') return 'Online';
        if (isOnline === false || isOnline === 0 || isOnlineValue === '0' || isOnlineValue === 'false') return 'Offline';

        const lastSeen = pick(user, ['last_seen_at', 'last_activity_at', 'last_login_at']);
        if (lastSeen) {
            const lastSeenTime = new Date(lastSeen).getTime();
            if (Number.isFinite(lastSeenTime)) {
                return Date.now() - lastSeenTime <= 5 * 60 * 1000 ? 'Online' : 'Offline';
            }
        }

        return 'Offline';
    }

    function normalizeUser(user, index) {
        const cityValue = pick(user, ['city', 'kota']);
        const provinceValue = pick(user, ['province.name', 'province', 'provinsi']);
        const fallbackLocation = pick(user, ['location', 'address']);
        const locationParts = [cityValue, provinceValue]
            .map(value => (typeof value === 'string' ? value.trim() : ''))
            .filter(Boolean);
        const location = locationParts.length > 0
            ? locationParts.join(', ')
            : (typeof fallbackLocation === 'string' && fallbackLocation.trim() ? fallbackLocation : 'Indonesia');

        return {
            id: pick(user, ['id', 'user_id']) ?? index,
            name: pick(user, ['name', 'full_name', 'username']) ?? `User #${index + 1}`,
            email: pick(user, ['email']) ?? '-',
            phone: pick(user, ['phone', 'phone_number']) ?? null,
            lat: toNumber(pick(user, ['lat', 'latitude', 'current_lat', 'current_latitude', 'location.lat', 'location.latitude'])),
            lng: toNumber(pick(user, ['lng', 'lon', 'long', 'longitude', 'current_lng', 'current_longitude', 'location.lng', 'location.longitude'])),
            status: resolveStatus(user),
            lastSeen: pick(user, ['last_seen_at', 'last_activity_at', 'last_login_at', 'updated_at']),
            location
        };
    }

    function getStatusMeta(user) {
        const isOnline = user.status === 'Online';
        return {
            icon: isOnline ? onlineUserIcon : offlineUserIcon,
            badge: isOnline ? 'bg-success' : 'bg-danger'
        };
    }

    function formatDateTime(value) {
        if (!value) return 'No timestamp';
        const date = new Date(value);
        if (!Number.isFinite(date.getTime())) return String(value);

        return date.toLocaleString('id-ID', {
            day: '2-digit',
            month: 'short',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function getTimestamp(value) {
        if (!value) return 0;
        const time = new Date(value).getTime();
        return Number.isFinite(time) ? time : 0;
    }

    function setText(id, value) {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    }

    function updateMapStats(allUsers, usersWithLocation) {
        const onlineCount = usersWithLocation.filter(user => user.status === 'Online').length;
        const offlineCount = usersWithLocation.filter(user => user.status === 'Offline').length;
        const visibleFeedCount = Math.min(usersWithLocation.length, MAP_FEED_LIMIT);

        setText('totalUsersCount', allUsers.length.toLocaleString('id-ID'));
        setText('mapTotalPins', usersWithLocation.length.toLocaleString('id-ID'));
        setText('mapOnlineCount', onlineCount.toLocaleString('id-ID'));
        setText('mapOfflineCount', offlineCount.toLocaleString('id-ID'));
        setText('mapLastUpdated', new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }));
        setText('mapFeedSummary', `Showing ${visibleFeedCount.toLocaleString('id-ID')} of ${usersWithLocation.length.toLocaleString('id-ID')} users with location`);
    }

    function renderUserFeed(usersWithLocation) {
        const feed = document.getElementById('mapUserFeed');
        if (!feed) return;

        if (usersWithLocation.length === 0) {
            feed.innerHTML = `
                <div class="text-center text-muted py-5">
                    <i class="bi bi-person-location fs-2 d-block mb-2"></i>
                    <strong class="d-block">Belum ada user dengan lokasi</strong>
                    <small>Data akan muncul otomatis saat backend mengirim koordinat.</small>
                </div>
            `;
            return;
        }

        const visibleUsers = usersWithLocation
            .slice()
            .sort((a, b) => getTimestamp(b.lastSeen) - getTimestamp(a.lastSeen))
            .slice(0, MAP_FEED_LIMIT);
        feed.innerHTML = visibleUsers.map((user, index) => {
            const meta = getStatusMeta(user);

            return `
                <button type="button" class="map-user-item" data-map-marker="${user.markerIndex}">
                    <span class="map-user-avatar d-inline-flex align-items-center justify-content-center">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    <span class="flex-grow-1 overflow-hidden">
                        <span class="map-user-name d-block fw-bold text-truncate">${escapeHtml(user.name)}</span>
                        <span class="map-user-email d-block text-truncate">${escapeHtml(user.email)}</span>
                        <span class="map-user-time d-block">${escapeHtml(user.location)} - ${escapeHtml(formatDateTime(user.lastSeen))}</span>
                    </span>
                    <span class="badge ${meta.badge} rounded-pill">${escapeHtml(user.status)}</span>
                </button>
            `;
        }).join('');

        feed.querySelectorAll('[data-map-marker]').forEach(button => {
            button.addEventListener('click', () => {
                const marker = activeMarkers[Number(button.dataset.mapMarker)];
                if (!marker) return;

                focusMarker(marker);
            });
        });
    }

    function focusMarker(marker) {
        const targetZoom = Math.max(map.getZoom(), 8);
        let popupOpened = false;

        function openPopup() {
            if (popupOpened) return;
            popupOpened = true;
            marker.openPopup();
        }

        map.closePopup();
        map.once('moveend', openPopup);
        map.flyTo(marker.getLatLng(), targetZoom, { animate: true, duration: 0.45 });
        setTimeout(openPopup, 550);
    }

    function renderUserMap(users) {
        const normalizedUsers = toArray(users).map(normalizeUser);
        const usersWithLocation = normalizedUsers.filter(user => Number.isFinite(user.lat) && Number.isFinite(user.lng));
        const emptyState = document.getElementById('mapEmptyState');
        const bounds = [];

        currentUsers = normalizedUsers;
        activeMarkers = [];
        markerLayer.clearLayers();

        usersWithLocation.forEach((user, index) => {
            const meta = getStatusMeta(user);
            user.markerIndex = index;
            const marker = L.marker([user.lat, user.lng], { icon: meta.icon }).bindPopup(`
                <div class="map-popup">
                    <h6 class="mb-1 fw-bold"><i class="bi bi-person-fill me-1"></i>${escapeHtml(user.name)}</h6>
                    <div class="text-muted small mb-1"><i class="bi bi-envelope me-1"></i>${escapeHtml(user.email)}</div>
                    <div class="text-muted small mb-2"><i class="bi bi-geo-alt me-1"></i>${escapeHtml(user.location)}</div>
                    <div class="d-flex align-items-center justify-content-between gap-2">
                        <span class="badge ${meta.badge} rounded-pill">${escapeHtml(user.status)}</span>
                        <small class="text-muted">${escapeHtml(formatDateTime(user.lastSeen))}</small>
                    </div>
                </div>
            `, { autoPan: false });

            marker.addTo(markerLayer);
            activeMarkers[index] = marker;
            bounds.push([user.lat, user.lng]);
        });

        updateMapStats(normalizedUsers, usersWithLocation);
        renderUserFeed(usersWithLocation);

        if (emptyState) {
            emptyState.style.display = usersWithLocation.length === 0 ? 'flex' : 'none';
        }

        if (usersWithLocation.length === 1) {
            map.setView([usersWithLocation[0].lat, usersWithLocation[0].lng], 7);
        } else if (usersWithLocation.length > 1) {
            map.fitBounds(bounds, { padding: [50, 50] });
        } else {
            map.setView([-2.5, 118], 5);
        }
    }

    renderUserMap(mainData);

    window.NusantaraUserMap = {
        render: renderUserMap,
        getUsers: () => currentUsers,
        normalizeUser
    };
}

document.addEventListener('DOMContentLoaded', () => {
    initCharts();
    initUserMap();
});
