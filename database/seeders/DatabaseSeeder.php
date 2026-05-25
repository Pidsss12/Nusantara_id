<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Province;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin NusantaraGreen',
            'email' => 'admin@nusantaragreen.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        // Create Test Users
        $users = [];
        for ($i = 1; $i <= 10; $i++) {
            $users[] = User::create([
                'name' => "User Test $i",
                'email' => "user$i@test.com",
                'password' => bcrypt('password'),
                'role' => 'user'
            ]);
        }

        // Create Provinces
        $provinces = [
            ['name' => 'Papua Barat', 'capital' => 'Manokwari', 'island' => 'Papua'],
            ['name' => 'Jawa Tengah', 'capital' => 'Semarang', 'island' => 'Jawa'],
            ['name' => 'Jawa Timur', 'capital' => 'Surabaya', 'island' => 'Jawa'],
            ['name' => 'Bali', 'capital' => 'Denpasar', 'island' => 'Bali'],
            ['name' => 'Nusa Tenggara Timur', 'capital' => 'Kupang', 'island' => 'Nusa Tenggara'],
            ['name' => 'Sumatera Utara', 'capital' => 'Medan', 'island' => 'Sumatera'],
            ['name' => 'Kalimantan Tengah', 'capital' => 'Palangkaraya', 'island' => 'Kalimantan'],
            ['name' => 'Sulawesi Utara', 'capital' => 'Manado', 'island' => 'Sulawesi'],
        ];
        foreach ($provinces as $p) {
            Province::create($p);
        }

        // Create Destinations
        $destinations = [
            ['province_id' => 1, 'name' => 'Raja Ampat', 'slug' => 'raja-ampat', 'category' => 'Marine', 'description' => 'Surga bawah laut dengan keindahan terumbu karang terbaik dunia', 'price' => 2500000, 'location' => 'Kepulauan Raja Ampat', 'rating' => 4.9, 'bookings_count' => 542],
            ['province_id' => 2, 'name' => 'Candi Borobudur', 'slug' => 'borobudur', 'category' => 'Heritage', 'description' => 'Candi Buddha terbesar di dunia, warisan UNESCO', 'price' => 350000, 'location' => 'Magelang, Jawa Tengah', 'rating' => 4.8, 'bookings_count' => 423],
            ['province_id' => 5, 'name' => 'Taman Nasional Komodo', 'slug' => 'komodo', 'category' => 'Wildlife', 'description' => 'Habitat asli komodo, kadal terbesar di dunia', 'price' => 1750000, 'location' => 'Labuan Bajo, NTT', 'rating' => 4.9, 'bookings_count' => 387],
            ['province_id' => 3, 'name' => 'Gunung Bromo', 'slug' => 'bromo', 'category' => 'Mountain', 'description' => 'Gunung berapi aktif dengan pemandangan matahari terbit spektakuler', 'price' => 450000, 'location' => 'Probolinggo, Jawa Timur', 'rating' => 4.7, 'bookings_count' => 298],
            ['province_id' => 6, 'name' => 'Danau Toba', 'slug' => 'danau-toba', 'category' => 'Lake', 'description' => 'Danau vulkanik terbesar di dunia dengan Pulau Samosir', 'price' => 250000, 'location' => 'Sumatera Utara', 'rating' => 4.6, 'bookings_count' => 245],
            ['province_id' => 4, 'name' => 'Nusa Dua Beach', 'slug' => 'nusa-dua', 'category' => 'Beach', 'description' => 'Pantai eksklusif dengan resort mewah dan air jernih', 'price' => 300000, 'location' => 'Bali Selatan', 'rating' => 4.8, 'bookings_count' => 156],
            ['province_id' => 7, 'name' => 'Tanjung Puting', 'slug' => 'tanjung-puting', 'category' => 'Wildlife', 'description' => 'Taman nasional orangutan di Kalimantan', 'price' => 1500000, 'location' => 'Kalimantan Tengah', 'rating' => 4.5, 'bookings_count' => 89, 'status' => 'Inactive'],
            ['province_id' => 8, 'name' => 'Bunaken', 'slug' => 'bunaken', 'category' => 'Marine', 'description' => 'Taman laut dengan biodiversitas tinggi', 'price' => 500000, 'location' => 'Manado', 'rating' => 4.7, 'bookings_count' => 134],
        ];
        
        $destModels = [];
        foreach ($destinations as $d) {
            $destModels[] = Destination::create($d);
        }

        // Create Packages
        $packages = [
            ['name' => 'Raja Ampat Premium', 'destination_id' => 1, 'duration' => '5D/4N', 'price' => 12500000, 'max_participants' => 15, 'description' => 'Paket diving premium dengan akomodasi mewah', 'bookings_count' => 234],
            ['name' => 'Borobudur Heritage Tour', 'destination_id' => 2, 'duration' => '2D/1N', 'price' => 1500000, 'max_participants' => 30, 'description' => 'Tur edukasi sejarah dan budaya', 'bookings_count' => 567],
            ['name' => 'Komodo Adventure', 'destination_id' => 3, 'duration' => '4D/3N', 'price' => 8500000, 'max_participants' => 12, 'description' => 'Petualangan ke pulau komodo', 'bookings_count' => 189],
            ['name' => 'Bromo Sunrise', 'destination_id' => 4, 'duration' => '2D/1N', 'price' => 2000000, 'max_participants' => 25, 'description' => 'Menikmati sunrise spektakuler', 'bookings_count' => 423],
            ['name' => 'Toba Cultural Journey', 'destination_id' => 5, 'duration' => '3D/2N', 'price' => 3500000, 'max_participants' => 20, 'description' => 'Eksplorasi budaya Batak', 'bookings_count' => 156],
            ['name' => 'Bali Beach Escape', 'destination_id' => 6, 'duration' => '4D/3N', 'price' => 5500000, 'max_participants' => 10, 'description' => 'Liburan pantai eksklusif', 'bookings_count' => 312, 'status' => 'Inactive'],
        ];
        
        $pkgModels = [];
        foreach ($packages as $p) {
            $pkgModels[] = Package::create($p);
        }

        // Create Sample Bookings
        $statuses = ['Pending', 'Confirmed', 'Cancelled'];
        for ($i = 0; $i < 20; $i++) {
            Booking::create([
                'booking_code' => 'BK' . str_pad($i + 10001, 8, '0', STR_PAD_LEFT),
                'user_id' => $users[array_rand($users)]->id,
                'destination_id' => rand(1, 6),
                'package_id' => rand(1, 6),
                'customer_name' => 'Customer ' . ($i + 1),
                'customer_email' => 'customer' . ($i + 1) . '@email.com',
                'customer_phone' => '0812345678' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'institution' => $i % 3 == 0 ? 'PT Company ' . $i : null,
                'visit_date' => now()->addDays(rand(1, 30)),
                'participants' => rand(5, 30),
                'total_amount' => rand(500000, 15000000),
                'status' => $statuses[array_rand($statuses)],
                'notes' => $i % 4 == 0 ? 'Catatan khusus untuk booking ' . ($i + 1) : null,
            ]);
        }
    }
}
