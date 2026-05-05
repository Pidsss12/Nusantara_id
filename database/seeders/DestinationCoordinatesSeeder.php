<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationCoordinatesSeeder extends Seeder
{
    /**
     * 38+ Ecotourism Destinations across all provinces of Indonesia
     * with accurate latitude and longitude coordinates
     */
    public function run(): void
    {
        $destinations = [
            // SUMATERA (8 locations)
            ['name' => 'Danau Toba', 'lat' => 2.6845, 'lng' => 98.8756, 'province_id' => 12], // Sumatera Utara
            ['name' => 'Bukit Lawang', 'lat' => 3.5560, 'lng' => 98.1303, 'province_id' => 12],
            ['name' => 'Pulau Weh', 'lat' => 5.8269, 'lng' => 95.2734, 'province_id' => 11], // Aceh
            ['name' => 'Danau Maninjau', 'lat' => -0.3114, 'lng' => 100.1894, 'province_id' => 13], // Sumatera Barat
            ['name' => 'Pulau Derawan', 'lat' => 2.2815, 'lng' => 118.2454, 'province_id' => 31], // Kalimantan Timur
            ['name' => 'Taman Nasional Kerinci Seblat', 'lat' => -2.0854, 'lng' => 101.2641, 'province_id' => 15], // Jambi
            ['name' => 'Pulau Bangka', 'lat' => -2.1194, 'lng' => 106.1169, 'province_id' => 19], // Bangka Belitung
            ['name' => 'Way Kambas National Park', 'lat' => -4.9306, 'lng' => 105.7708, 'province_id' => 18], // Lampung
            
            // JAWA (10 locations)
            ['name' => 'Gunung Bromo', 'lat' => -7.9425, 'lng' => 112.9531, 'province_id' => 35], // Jawa Timur
            ['name' => 'Candi Borobudur', 'lat' => -7.6079, 'lng' => 110.2038, 'province_id' => 33], // Jawa Tengah
            ['name' => 'Kawah Ijen', 'lat' => -8.0580, 'lng' => 114.2421, 'province_id' => 35],
            ['name' => 'Ujung Kulon National Park', 'lat' => -6.7608, 'lng' => 105.3376, 'province_id' => 36], // Banten
            ['name' => 'Kepulauan Karimunjawa', 'lat' => -5.8609, 'lng' => 110.4619, 'province_id' => 33],
            ['name' => 'Dieng Plateau', 'lat' => -7.2025, 'lng' => 109.9087, 'province_id' => 33],
            ['name' => 'Gunung Gede Pangrango', 'lat' => -6.7320, 'lng' => 106.9780, 'province_id' => 32], // Jawa Barat
            ['name' => 'Pantai Pangandaran', 'lat' => -7.6884, 'lng' => 108.6502, 'province_id' => 32],
            ['name' => 'Goa Jomblang', 'lat' => -7.9621, 'lng' => 110.3395, 'province_id' => 34], // DI Yogyakarta
            ['name' => 'Pulau Sempu', 'lat' => -8.4508, 'lng' => 112.6922, 'province_id' => 35],
            
            // BALI & NUSA TENGGARA (6 locations)
            ['name' => 'West Bali National Park', 'lat' => -8.1510, 'lng' => 114.4426, 'province_id' => 51], // Bali
            ['name' => 'Ubud Rice Terraces', 'lat' => -8.4395, 'lng' => 115.2620, 'province_id' => 51],
            ['name' => 'Gunung Rinjani', 'lat' => -8.4114, 'lng' => 116.4574, 'province_id' => 52], // NTB
            ['name' => 'Taman Nasional Komodo', 'lat' => -8.5455, 'lng' => 119.4892, 'province_id' => 53], // NTT
            ['name' => 'Pantai Pink', 'lat' => -8.5297, 'lng' => 119.5908, 'province_id' => 53],
            ['name' => 'Gili Islands', 'lat' => -8.3568, 'lng' => 116.0455, 'province_id' => 52],
            
            // KALIMANTAN (5 locations)
            ['name' => 'Tanjung Puting National Park', 'lat' => -2.8456, 'lng' => 111.6929, 'province_id' => 62], // Kalimantan Tengah
            ['name' => 'Danau Sentarum', 'lat' => 0.8167, 'lng' => 112.0083, 'province_id' => 61], // Kalimantan Barat
            ['name' => 'Pulau Maratua', 'lat' => 2.1531, 'lng' => 118.6222, 'province_id' => 64], // Kalimantan Utara
            ['name' => 'Bukit Baka Bukit Raya', 'lat' => -0.8500, 'lng' => 112.3500, 'province_id' => 62],
            ['name' => 'Mahakam River', 'lat' => -0.5022, 'lng' => 117.1536, 'province_id' => 64],
            
            // SULAWESI (6 locations)
            ['name' => 'Bunaken National Park', 'lat' => 1.6174, 'lng' => 124.7631, 'province_id' => 71], // Sulawesi Utara
            ['name' => 'Tana Toraja', 'lat' => -2.9745, 'lng' => 119.8450, 'province_id' => 73], // Sulawesi Selatan
            ['name' => 'Wakatobi National Park', 'lat' => -5.4818, 'lng' => 123.7680, 'province_id' => 74], // Sulawesi Tenggara
            ['name' => 'Togean Islands', 'lat' => -0.3833, 'lng' => 121.8333, 'province_id' => 72], // Sulawesi Tengah
            ['name' => 'Lore Lindu National Park', 'lat' => -1.4472, 'lng' => 120.1822, 'province_id' => 72],
            ['name' => 'Lake Poso', 'lat' => -1.9000, 'lng' => 120.6500, 'province_id' => 72],
            
            // MALUKU (3 locations)
            ['name' => 'Banda Islands', 'lat' => -4.5235, 'lng' => 129.9024, 'province_id' => 81], // Maluku
            ['name' => 'Ora Beach', 'lat' => -3.0333, 'lng' => 129.2167, 'province_id' => 81],
            ['name' => 'Kei Islands', 'lat' => -5.6623, 'lng' => 132.7501, 'province_id' => 81],
            
            // PAPUA (4 locations)
            ['name' => 'Raja Ampat', 'lat' => -0.2309, 'lng' => 130.5239, 'province_id' => 91], // Papua Barat
            ['name' => 'Lorentz National Park', 'lat' => -4.5833, 'lng' => 137.5167, 'province_id' => 94], // Papua
            ['name' => 'Baliem Valley', 'lat' => -3.9672, 'lng' => 138.9550, 'province_id' => 94],
            ['name' => 'Cenderawasih Bay', 'lat' => -2.1639, 'lng' => 134.5839, 'province_id' => 91],
        ];

        foreach ($destinations as $dest) {
            Destination::where('name', 'LIKE', '%' . $dest['name'] . '%')
                ->update([
                    'latitude' => $dest['lat'],
                    'longitude' => $dest['lng']
                ]);
        }
        
        $this->command->info('Updated ' . count($destinations) . ' destinations with coordinates!');
    }
}
