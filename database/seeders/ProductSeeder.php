<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::deleteDirectory('public/products');
        Storage::makeDirectory('public/products');

        $faker = Faker::create();

        Product::factory(100)->create()->each(function (Product $product) use ($faker) {
            $imagePath = $faker->image(storage_path('app/public/products'), 640, 480, null, false);
            $product->image()->create(['url' => 'products/' . $imagePath]);
        });
    }
}
