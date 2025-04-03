<div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #map {
            height: 500px;
            width: 100%;
            float: left;
            margin-right: 20px;
        }
        #chart {
            height: 400px;
            width: 100%;
            float: right;
        }
    </style>


        <x-header title="{{$title}}" separator progress-indicator>

        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />
        </x-slot:actions>
        </x-header>


    <div class="flex pb-8">
        <div class="w-full">
                @foreach($dataPenjualan as $data)
                    <button class="bg-purple-800 px-4 text-white radius-md" onclick="filter('{{ $data['kecamatan'] }}')"> CABANG  {{ $data['kecamatan'] }}</button>
                @endforeach
        </div>
    </div>

    <div class="flex">
        <div class="w-1/2">
            <div id="map"></div>
        </div>
        <div class="w-1/2bg-white">
            <h2>Grafik Penjualan dan Produk Terjual</h2>
            <canvas id="chart"></canvas>
        </div>
    </div>


    <div class="flex">
        <div class="w-1/2">

        </div>
        <div class="w-1/2bg-white">

        </div>
    </div>

    <script>
        // Data penjualan dengan koordinat
        const dataPenjualan =  @json($dataPenjualan);

        // Inisialisasi peta
        const map = L.map('map').setView([-6.2088, 106.8456], 11); // Koordinat tengah Jakarta

        // Tambahkan layer peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Menampilkan semua marker
        const markers = [];
        dataPenjualan.forEach(data => {
            const marker = L.marker([data.latitude, data.longitude]).addTo(map)
                .bindPopup(`Kecamatan: ${data.kecamatan}<br>Penjualan: ${data.penjualan}<br>Produk Terjual: ${data.produk_terjual}`);
            markers.push(marker);
        });

        // Fungsi untuk memfilter peta berdasarkan kecamatan
        function filter(kecamatan) {
            // Hapus semua marker dari peta
            markers.forEach(marker => {
                map.removeLayer(marker);
            });

            // Tambahkan marker yang sesuai dengan kecamatan yang dipilih
            const filteredData = dataPenjualan.filter(data => data.kecamatan === kecamatan);
            filteredData.forEach(data => {
                const marker = L.marker([data.latitude, data.longitude]).addTo(map)
                    .bindPopup(`Kecamatan: ${data.kecamatan}<br>Penjualan: ${data.penjualan}<br>Produk Terjual: ${data.produk_terjual}`);
            });
        }
    </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var ctx = document.getElementById('chart').getContext('2d');
                var dataPenjualan = @json($dataPenjualan);

                // Ambil data untuk grafik
                var labels = dataPenjualan.map(item => item.kecamatan);
                var penjualanData = dataPenjualan.map(item => item.penjualan);
                var produkTerjualData = dataPenjualan.map(item => item.produk_terjual);

                // Buat grafik
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Penjualan',
                                data: penjualanData,
                                backgroundColor: [
                                    'rgba(128, 0, 128, 0.2)', // Purple
                                    'rgba(75, 0, 130, 0.2)', // Indigo
                                    'rgba(128, 0, 128, 0.2)', // Purple
                                    'rgba(75, 0, 130, 0.2)', // Indigo
                                    'rgba(128, 0, 128, 0.2)'  // Purple
                                ],
                                borderColor: [
                                    'rgba(128, 0, 128, 1)', // Purple
                                    'rgba(75, 0, 130, 1)', // Indigo
                                    'rgba(128, 0, 128, 1)', // Purple
                                    'rgba(75, 0, 130, 1)', // Indigo
                                    'rgba(128, 0, 128, 1)'  // Purple
                                ],
                                borderWidth: 1,
                                borderWidth: 2
                            },
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
</div>
