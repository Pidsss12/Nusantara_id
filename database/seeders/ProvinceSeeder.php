<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = [
            // Sumatera
            ['name' => 'Aceh', 'island' => 'Sumatera', 'capital' => 'Banda Aceh'],
            ['name' => 'Sumatera Utara', 'island' => 'Sumatera', 'capital' => 'Medan'],
            ['name' => 'Sumatera Barat', 'island' => 'Sumatera', 'capital' => 'Padang'],
            ['name' => 'Riau', 'island' => 'Sumatera', 'capital' => 'Pekanbaru'],
            ['name' => 'Kepulauan Riau', 'island' => 'Sumatera', 'capital' => 'Tanjung Pinang'],
            ['name' => 'Jambi', 'island' => 'Sumatera', 'capital' => 'Jambi'],
            ['name' => 'Sumatera Selatan', 'island' => 'Sumatera', 'capital' => 'Palembang'],
            ['name' => 'Bangka Belitung', 'island' => 'Sumatera', 'capital' => 'Pangkalpinang'],
            ['name' => 'Bengkulu', 'island' => 'Sumatera', 'capital' => 'Bengkulu'],
            ['name' => 'Lampung', 'island' => 'Sumatera', 'capital' => 'Bandar Lampung'],
            
            // Jawa
            ['name' => 'Banten', 'island' => 'Jawa', 'capital' => 'Serang'],
            ['name' => 'DKI Jakarta', 'island' => 'Jawa', 'capital' => 'Jakarta'],
            ['name' => 'Jawa Barat', 'island' => 'Jawa', 'capital' => 'Bandung'],
            ['name' => 'Jawa Tengah', 'island' => 'Jawa', 'capital' => 'Semarang'],
            ['name' => 'DI Yogyakarta', 'island' => 'Jawa', 'capital' => 'Yogyakarta'],
            ['name' => 'Jawa Timur', 'island' => 'Jawa', 'capital' => 'Surabaya'],
            
            // Kalimantan
            ['name' => 'Kalimantan Barat', 'island' => 'Kalimantan', 'capital' => 'Pontianak'],
            ['name' => 'Kalimantan Tengah', 'island' => 'Kalimantan', 'capital' => 'Palangkaraya'],
            ['name' => 'Kalimantan Selatan', 'island' => 'Kalimantan', 'capital' => 'Banjarmasin'],
            ['name' => 'Kalimantan Timur', 'island' => 'Kalimantan', 'capital' => 'Samarinda'],
            ['name' => 'Kalimantan Utara', 'island' => 'Kalimantan', 'capital' => 'Tanjung Selor'],
            
            // Sulawesi
            ['name' => 'Sulawesi Utara', 'island' => 'Sulawesi', 'capital' => 'Manado'],
            ['name' => 'Gorontalo', 'island' => 'Sulawesi', 'capital' => 'Gorontalo'],
            ['name' => 'Sulawesi Tengah', 'island' => 'Sulawesi', 'capital' => 'Palu'],
            ['name' => 'Sulawesi Barat', 'island' => 'Sulawesi', 'capital' => 'Mamuju'],
            ['name' => 'Sulawesi Selatan', 'island' => 'Sulawesi', 'capital' => 'Makassar'],
            ['name' => 'Sulawesi Tenggara', 'island' => 'Sulawesi', 'capital' => 'Kendari'],
            
            // Bali & Nusa Tenggara
            ['name' => 'Bali', 'island' => 'Bali & Nusa Tenggara', 'capital' => 'Denpasar'],
            ['name' => 'Nusa Tenggara Barat', 'island' => 'Bali & Nusa Tenggara', 'capital' => 'Mataram'],
            ['name' => 'Nusa Tenggara Timur', 'island' => 'Bali & Nusa Tenggara', 'capital' => 'Kupang'],
            
            // Maluku
            ['name' => 'Maluku', 'island' => 'Maluku', 'capital' => 'Ambon'],
            ['name' => 'Maluku Utara', 'island' => 'Maluku', 'capital' => 'Sofifi'],
            
            // Papua
            ['name' => 'Papua', 'island' => 'Papua', 'capital' => 'Jayapura'],
            ['name' => 'Papua Barat', 'island' => 'Papua', 'capital' => 'Manokwari'],
            ['name' => 'Papua Tengah', 'island' => 'Papua', 'capital' => 'Nabire'],
            ['name' => 'Papua Pegunungan', 'island' => 'Papua', 'capital' => 'Jayawijaya'],
            ['name' => 'Papua Selatan', 'island' => 'Papua', 'capital' => 'Merauke'],
            ['name' => 'Papua Barat Daya', 'island' => 'Papua', 'capital' => 'Sorong'],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
