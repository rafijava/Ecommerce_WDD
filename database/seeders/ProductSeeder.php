<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    private function imageUrl(string $text, string $category): string
    {
        $colours = [
            'Men' => ['1e3a8a', 'ffffff'],
            'Women' => ['831843', 'ffffff'],
            'Accessories' => ['064e3b', 'ffffff'],
        ];

        [$bg, $fg] = $colours[$category] ?? ['4b5563', 'ffffff'];

        return 'https://placehold.co/600x400/'.$bg.'/'.$fg.'?text='.urlencode($text);
    }

    private array $products = [
        [
            'category' => 'Men',
            'name' => 'UrbanFit Classic T-Shirt',
            'price' => 850.00,
            'sku' => 'UFM-TS-001',
            'description' => 'Soft cotton everyday t-shirt with a modern fit.',
            'variants' => ['S' => 12, 'M' => 20, 'L' => 15, 'XL' => 8],
        ],
        [
            'category' => 'Men',
            'name' => 'UrbanFit Cargo Pants',
            'price' => 1890.00,
            'sku' => 'UFM-CP-002',
            'description' => 'Durable cargo pants with multiple utility pockets.',
            'variants' => ['S' => 7, 'M' => 11, 'L' => 9, 'XL' => 5],
        ],
        [
            'category' => 'Men',
            'name' => 'UrbanFit Hoodie',
            'price' => 2450.00,
            'sku' => 'UFM-HD-003',
            'description' => 'Warm fleece hoodie for casual and gym wear.',
            'variants' => ['S' => 6, 'M' => 14, 'L' => 10, 'XL' => 4],
        ],
        [
            'category' => 'Women',
            'name' => 'UrbanFit Summer Top',
            'price' => 790.00,
            'sku' => 'UFW-ST-004',
            'description' => 'Lightweight summer top with breathable fabric.',
            'variants' => ['S' => 15, 'M' => 18, 'L' => 12, 'XL' => 6],
        ],
        [
            'category' => 'Women',
            'name' => 'UrbanFit Denim Jacket',
            'price' => 3250.00,
            'sku' => 'UFW-DJ-005',
            'description' => 'Stylish denim jacket for all seasons.',
            'variants' => ['S' => 5, 'M' => 0, 'L' => 8, 'XL' => 3],
        ],
        [
            'category' => 'Women',
            'name' => 'UrbanFit Leggings',
            'price' => 1190.00,
            'sku' => 'UFW-LG-006',
            'description' => 'High-waist stretch leggings for workouts.',
            'variants' => ['S' => 8, 'M' => 13, 'L' => 11, 'XL' => 7],
        ],
        [
            'category' => 'Accessories',
            'name' => 'UrbanFit Sports Cap',
            'price' => 490.00,
            'sku' => 'UFA-SC-007',
            'description' => 'Adjustable sports cap with embroidered logo.',
            'variants' => ['S' => 20, 'M' => 20, 'L' => 20, 'XL' => 20],
        ],
        [
            'category' => 'Accessories',
            'name' => 'UrbanFit Leather Wallet',
            'price' => 1200.00,
            'sku' => 'UFA-LW-008',
            'description' => 'Genuine leather wallet with card slots.',
            'variants' => ['S' => 0, 'M' => 0, 'L' => 0, 'XL' => 0],
        ],
    ];

    public function run(): void
    {
        foreach ($this->products as $data) {
            $category = Category::firstOrCreate(
                ['name' => $data['category']],
                ['slug' => Str::slug($data['category'])]
            );

            $product = Product::updateOrCreate(
                ['sku' => $data['sku']],
                [
                    'category_id' => $category->id,
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']),
                    'price' => $data['price'],
                    'description' => $data['description'],
                    'image' => $this->imageUrl($data['name'], $data['category']),
                ]
            );

            foreach ($data['variants'] as $size => $stock) {
                $product->variants()->updateOrCreate(
                    ['size' => $size],
                    ['stock' => $stock]
                );
            }
        }
    }
}
