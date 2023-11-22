<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Gold Diamond',
                'description' => ' Casio Brand',
                'image' => 'https://www.casio.com/content/dam/casio/product-info/locales/intl/en/timepiece/product/watch/M/MT/MTP/mtp-b145g-9av/assets/MTP-B145G-9AV.png.transform/product-panel/image.png',
                'price' => 1500
            ],
            [
                'name' => 'Rolex watches',
                'description' => 'Rolex Brand',
                'image' => 'https://www.casio.com/content/dam/casio/product-info/locales/intl/en/timepiece/product/watch/M/MT/MTP/mtp-b145d-2a2v/assets/MTP-B145D-2A2V.png.transform/product-panel/image.png',
                'price' => 1100
            ],
            [
                'name' => 'EFV-650D-2AV',
                'description' => 'EDIFICE ',
                'image' => 'https://www.casio.com/content/dam/casio/product-info/locales/intl/en/timepiece/product/watch/G/GM/GMW/gmw-b5000bpc-1/assets/GMW-B5000BPC-1.png.transform/product-panel/image.png',
                'price' => 800
            ],
            [
                'name' => 'Casio',
                'description' => 'EDIFICE',
                'image' => 'https://www.casio.com/content/dam/casio/product-info/locales/intl/en/timepiece/product/watch/E/EF/EFV/efv-650d-2av/assets/EFV-650D-2AVU.png.transform/product-panel/image.png',
                'price' => 500
            ]
        ];

        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}
