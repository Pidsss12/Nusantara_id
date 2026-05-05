<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            // Bali
            [
                'name' => 'Ubud Monkey Forest',
                'description' => 'Hutan suci dengan ratusan monyet ekor panjang di jantung Ubud. Nikmati keindahan alam tropis dan arsitektur pura yang megah.',
                'price' => 350000,
                'location' => 'Ubud, Bali',
                'province_id' => 28, // Bali
                'photo' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=600',
                'rating' => 4.7,
            ],
            [
                'name' => 'Tanah Lot Temple',
                'description' => 'Pura ikonik di atas batu karang yang dikelilingi ombak. Tempat terbaik untuk menyaksikan sunset di Bali.',
                'price' => 250000,
                'location' => 'Tabanan, Bali',
                'province_id' => 28,
                'photo' => 'https://images.unsplash.com/photo-1559628376-f3fe5f782a2e?w=600',
                'rating' => 4.8,
            ],
            
            // Papua Barat Daya (Raja Ampat)
            [
                'name' => 'Raja Ampat Paradise',
                'description' => 'Surga bawah laut dengan keanekaragaman hayati terkaya di dunia. Snorkeling dan diving di perairan kristal yang menakjubkan.',
                'price' => 5500000,
                'location' => 'Raja Ampat, Papua Barat Daya',
                'province_id' => 38,
                'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRS1LQb4mx-Y9VS2j0A3mD9skfW8yIUo3s_pg&s',
                'rating' => 4.9,
            ],
            
            // Jawa Tengah
            [
                'name' => 'Sunrise Borobudur',
                'description' => 'Menikmati kemegahan matahari terbit dari candi Buddha terbesar di dunia. Pengalaman spiritual dan budaya yang tak terlupakan.',
                'price' => 750000,
                'location' => 'Magelang, Jawa Tengah',
                'province_id' => 14,
                'photo' => 'https://www.indonesia.travel/contentassets/ea5919f254c2494c9579fa4ce3522bcb/candi-borobudur-1.jpeg',
                'rating' => 4.8,
            ],
            [
                'name' => 'Dieng Plateau',
                'description' => 'Dataran tinggi dengan kawah belerang, telaga warna-warni, dan candi Hindu kuno. Udara sejuk pegunungan yang menyegarkan.',
                'price' => 450000,
                'location' => 'Wonosobo, Jawa Tengah',
                'province_id' => 14,
                'photo' => 'https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=600',
                'rating' => 4.6,
            ],
            
            // Nusa Tenggara Timur (Komodo)
            [
                'name' => 'Taman Nasional Komodo',
                'description' => 'Petualangan bertemu hewan purba komodo di habitat aslinya. Trekking di savana dan pantai pink yang eksotis.',
                'price' => 2100000,
                'location' => 'Labuan Bajo, NTT',
                'province_id' => 30,
                'photo' => 'https://indonesiajuara.asia/wp-content/uploads/2024/12/Pulau-Padar-di-Taman-Nasional-Komodo-_-IndonesiaJuara-Trip_11zon.webp',
                'rating' => 4.9,
            ],
            
            // DI Yogyakarta
            [
                'name' => 'Pram ba nan Temple Tour',
                'description' => 'Kompleks candi Hindu terbesar di Indonesia dengan arsitektur yang memukau. Sunset tour dengan pemandangan spektakuler.',
                'price' => 350000,
                'location' => 'Sleman, DI Yogyakarta',
                'province_id' => 15,
                'photo' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=600',
                'rating' => 4.7,
            ],
            
            // Jawa Barat
            [
                'name' => 'Kawah Putih Ciwidey',
                'description' => 'Danau kawah dengan air berwarna putih kehijauan yang unik. Suasana mistis dengan kabut tebal di pagi hari.',
                'price' => 200000,
                'location' => 'Bandung, Jawa Barat',
                'province_id' => 13,
                'photo' => 'https://images.unsplash.com/photo-1588412079929-790b9f165b2f?w=600',
                'rating' => 4.5,
            ],
            
            // Sumatera Utara
            [
                'name' => 'Danau Toba Experience',
                'description' => 'Danau vulkanik terbesar di Asia Tenggara dengan Pulau Samosir di tengahnya. Budaya Batak yang kaya dan pemandangan alam menawan.',
                'price' => 850000,
                'location' => 'Danau Toba, Sumatera Utara',
                'province_id' => 2,
                'photo' => 'https://images.unsplash.com/photo-1598977123118-4e30ba3c4f5b?w=600',
                'rating' => 4.8,
            ],
        ];

        DB::table('destinations')->insert($destinations);
    }
}
