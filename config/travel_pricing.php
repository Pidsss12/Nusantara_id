<?php

// Curated real-world options near each destination. Prices are practical
// booking estimates for the demo app; hotels/restaurants may change rates.
return [
    'destinations' => [
        'Raja Ampat' => [
            'hotels' => [
                ['name' => 'Papua Explorers Eco Resort', 'price' => 4500000],
                ['name' => 'Raja Ampat Dive Lodge', 'price' => 2300000],
                ['name' => 'Waiwo Dive Resort', 'price' => 1000000],
                ['name' => 'Meridian Adventure Marina Club & Resort', 'price' => 1800000],
            ],
            'restaurants' => [
                [
                    'name' => 'Papua Explorers Resort Dining',
                    'menus' => [
                        ['name' => 'Ikan Kuah Kuning Papua', 'price' => 85000],
                        ['name' => 'Fresh Grilled Reef Fish', 'price' => 120000],
                        ['name' => 'Nasi Goreng Seafood', 'price' => 75000],
                    ],
                ],
                [
                    'name' => 'Meridian Adventure Marina Club Restaurant',
                    'menus' => [
                        ['name' => 'Fish and Chips', 'price' => 135000],
                        ['name' => 'Chicken Burger', 'price' => 120000],
                        ['name' => 'Mie Goreng Seafood', 'price' => 85000],
                    ],
                ],
            ],
        ],

        'Candi Borobudur' => [
            'hotels' => [
                ['name' => 'Plataran Borobudur Resort & Spa', 'price' => 4000000],
                ['name' => 'Plataran Heritage Borobudur Hotel', 'price' => 1800000],
                ['name' => 'Amata Borobudur Resort', 'price' => 650000],
                ['name' => 'Sarasvati Borobudur Hotel', 'price' => 550000],
            ],
            'restaurants' => [
                [
                    'name' => 'Enam Langit by Plataran',
                    'menus' => [
                        ['name' => 'Nasi Goreng Enam Langit', 'price' => 125000],
                        ['name' => 'Bebek Goreng Mentega', 'price' => 150000],
                        ['name' => 'Sate Lilit Magelang', 'price' => 85000],
                    ],
                ],
                [
                    'name' => 'Kedai Bukit Rhema',
                    'menus' => [
                        ['name' => 'Nasi Ayam Sambal Bawang', 'price' => 35000],
                        ['name' => 'Bakmi Djowo Rebus', 'price' => 28000],
                        ['name' => 'Mango Sticky Rice', 'price' => 17000],
                    ],
                ],
            ],
        ],

        'Taman Nasional Komodo' => [
            'hotels' => [
                ['name' => 'Meruorah Komodo Labuan Bajo', 'price' => 2100000],
                ['name' => 'Loccal Collection Hotel Labuan Bajo', 'price' => 1400000],
                ['name' => 'Puri Sari Beach Hotel', 'price' => 950000],
                ['name' => 'Seaesta Komodo Hostel & Hotel', 'price' => 600000],
            ],
            'restaurants' => [
                [
                    'name' => 'La Cucina Labuan Bajo',
                    'menus' => [
                        ['name' => 'Pizza Margherita', 'price' => 95000],
                        ['name' => 'Seafood Pasta', 'price' => 135000],
                        ['name' => 'Tiramisu', 'price' => 55000],
                    ],
                ],
                [
                    'name' => 'Seaesta Bar & Restaurant',
                    'menus' => [
                        ['name' => 'Fish Burger', 'price' => 95000],
                        ['name' => 'Chicken Rice Bowl', 'price' => 75000],
                        ['name' => 'Smoothie Bowl', 'price' => 65000],
                    ],
                ],
            ],
        ],

        'Gunung Bromo' => [
            'hotels' => [
                ['name' => 'Plataran Bromo Resort & Venue', 'price' => 2900000],
                ['name' => 'Jiwa Jawa Resort Bromo', 'price' => 1800000],
                ['name' => 'Lava View Lodge Bromo', 'price' => 850000],
                ['name' => 'Cemara Indah Hotel Bromo', 'price' => 450000],
            ],
            'restaurants' => [
                [
                    'name' => 'Bawangan Bromo Resto',
                    'menus' => [
                        ['name' => 'Ayam Bakar Bawangan', 'price' => 110000],
                        ['name' => 'Ikan Gurame Bakar', 'price' => 85000],
                        ['name' => 'Sup Buntut Hangat', 'price' => 75000],
                    ],
                ],
                [
                    'name' => 'Teras Bromo by Plataran',
                    'menus' => [
                        ['name' => 'Nasi Goreng Bromo', 'price' => 75000],
                        ['name' => 'Bakmi Godog Tengger', 'price' => 65000],
                        ['name' => 'Wedang Ronde Bromo', 'price' => 30000],
                    ],
                ],
            ],
        ],

        'Danau Toba' => [
            'hotels' => [
                ['name' => 'Taman Simalem Resort', 'price' => 1600000],
                ['name' => 'Hotel Niagara Parapat', 'price' => 850000],
                ['name' => 'Tabo Cottages Samosir', 'price' => 650000],
                ['name' => 'Carolina Hotel Tuk Tuk', 'price' => 350000],
            ],
            'restaurants' => [
                [
                    'name' => 'Tabo Restaurant Tuk Tuk',
                    'menus' => [
                        ['name' => 'Chicken Schnitzel', 'price' => 85000],
                        ['name' => 'Nasi Goreng Tabo', 'price' => 45000],
                        ['name' => 'Apple Pie', 'price' => 35000],
                    ],
                ],
                [
                    'name' => 'Jenny\'s Restaurant Tuk Tuk',
                    'menus' => [
                        ['name' => 'Ikan Bakar Danau Toba', 'price' => 75000],
                        ['name' => 'Chicken Curry', 'price' => 55000],
                        ['name' => 'Mie Goreng', 'price' => 30000],
                    ],
                ],
            ],
        ],

        'Default' => [
            'hotels' => [
                ['name' => 'Hotel Bintang 3 Standar', 'price' => 450000],
                ['name' => 'Guest House Lokal', 'price' => 200000],
            ],
            'restaurants' => [
                [
                    'name' => 'Restoran Lokal',
                    'menus' => [
                        ['name' => 'Nasi Campur', 'price' => 35000],
                        ['name' => 'Ayam Bakar', 'price' => 45000],
                    ],
                ],
            ],
        ],
    ],
];
