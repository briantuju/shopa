<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            [
                'user' => [
                    'name' => 'Nike Admin',
                    'email' => 'nike@example.com',
                    'password' => bcrypt('password'),
                ],
                'vendor' => [
                    'business_name' => 'Nike Inc.',
                    'business_type' => 'company',
                    'registration_number' => 'NIKE-12345',
                    'tax_id' => 'US-TAX-998877',
                    'address_line' => 'One Bowerman Drive',
                    'city' => 'Beaverton',
                    'state' => 'Oregon',
                    'country' => 'USA',
                    'postal_code' => '97005',
                    'store_name' => 'Nike Official Store',
                    'store_description' => 'Global leader in sportswear and athletic shoes.',
                    'store_logo' => 'logos/nike_logo.png',
                    'store_banner' => 'logos/nike_logo.png',
                    'status' => 'approved',
                ],
                'categories' => ['Sports & Outdoors', 'Footwear'],
            ],
            [
                'user' => [
                    'name' => 'Apple Admin',
                    'email' => 'apple@example.com',
                    'password' => bcrypt('password'),
                ],
                'vendor' => [
                    'business_name' => 'Apple Inc.',
                    'business_type' => 'company',
                    'registration_number' => 'APPLE-98765',
                    'tax_id' => 'US-TAX-112233',
                    'address_line' => 'One Apple Park Way',
                    'city' => 'Cupertino',
                    'state' => 'California',
                    'country' => 'USA',
                    'postal_code' => '95014',
                    'store_name' => 'Apple Store',
                    'store_description' => 'Premium electronics and gadgets by Apple.',
                    'store_logo' => 'logos/apple_logo.jpg',
                    'store_banner' => 'logos/apple_logo.jpg',
                    'status' => 'approved',
                ],
                'categories' => ['Electronics'],
            ],
            [
                'user' => [
                    'name' => 'Zara Admin',
                    'email' => 'zara@example.com',
                    'password' => bcrypt('password'),
                ],
                'vendor' => [
                    'business_name' => 'Zara',
                    'business_type' => 'company',
                    'registration_number' => 'ZARA-67890',
                    'tax_id' => 'EU-TAX-445566',
                    'address_line' => 'Av. de la Diputación',
                    'city' => 'Arteixo',
                    'state' => 'A Coruña',
                    'country' => 'Spain',
                    'postal_code' => '15142',
                    'store_name' => 'Zara Official Store',
                    'store_description' => 'Fashion and apparel retailer.',
                    'store_logo' => 'logos/zara_logo.png',
                    'store_banner' => 'logos/zara_logo.png',
                    'status' => 'approved',
                ],
                'categories' => ['Apparel'],
            ],
            [
                'user' => [
                    'name' => 'Samsung Admin',
                    'email' => 'samsung@example.com',
                    'password' => bcrypt('password'),
                ],
                'vendor' => [
                    'business_name' => 'Samsung Electronics',
                    'business_type' => 'company',
                    'registration_number' => 'SAMSUNG-45678',
                    'tax_id' => 'KR-TAX-778899',
                    'address_line' => '129 Samsung-ro',
                    'city' => 'Suwon',
                    'state' => 'Gyeonggi-do',
                    'country' => 'South Korea',
                    'postal_code' => '16677',
                    'store_name' => 'Samsung Store',
                    'store_description' => 'Innovative electronics and home appliances.',
                    'store_logo' => 'logos/samsung_logo.png',
                    'store_banner' => 'logos/samsung_logo.png',
                    'status' => 'approved',
                ],
                'categories' => ['Electronics', 'Home & Kitchen'],
            ],
            [
                'user' => [
                    'name' => 'Adidas Admin',
                    'email' => 'adidas@example.com',
                    'password' => bcrypt('password'),
                ],
                'vendor' => [
                    'business_name' => 'Adidas Kenya',
                    'business_type' => 'company',
                    'registration_number' => 'ADIDAS-11223',
                    'tax_id' => 'KE-TAX-334455',
                    'address_line' => 'ABC Towers',
                    'city' => 'Nairobi',
                    'state' => 'Nairobi',
                    'country' => 'Kenya',
                    'postal_code' => '00100',
                    'store_name' => 'Adidas Official Store',
                    'store_description' => 'Premium athletic footwear and apparel.',
                    'store_logo' => 'logos/adidas_logo.png',
                    'store_banner' => 'logos/adidas_logo.png',
                    'status' => 'approved',
                ],
                'categories' => ['Apparel', 'Footwear'],
            ],
        ];

        foreach ($vendors as $data) {
            $user = User::firstOrCreate(['email' => $data['user']['email']], $data['user']);

            $user->email_verified_at = now();
            $user->save();

            $vendor = Vendor::firstOrCreate(['user_id' => $user->id], array_merge($data['vendor'], [
                'user_id' => $user->id,
            ]));

            // Attach categories by name
            $categoryIds = Category::whereIn('name', $data['categories'])
                ->pluck('id')->toArray();
            $vendor->categories()->attach($categoryIds);
        }
    }
}
