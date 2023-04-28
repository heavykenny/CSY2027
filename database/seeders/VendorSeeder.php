<?php

namespace Database\Seeders;


use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    public function run()
    {
        $category = Category::create([
            'name' => 'Fitness',
            'description' => 'Fitness equipment and accessories',
        ]);

        $vendors = [
            [
                'name' => 'Fitness Emporium',
                'email' => 'sales@fitnessemporium.com',
                'phone' => '555-1234',
                'address' => '123 Main St, Anytown USA',
                'products' => [
                    [
                        'name' => 'Treadmill',
                        'description' => 'Get your cardio in with our state-of-the-art treadmill.',
                        'price' => 1499.99,
                        'image_url' => 'https://via.placeholder.com/400x400',
                        'sizes' => ['S', 'M', 'L'],
                        'category_id' => $category->id,
                        'quantity' => 10,
                    ],
                    [
                        'name' => 'Weights Set',
                        'description' => 'Build strength and muscle with our complete weights set.',
                        'price' => 699.99,
                        'image_url' => 'https://via.placeholder.com/400x400',
                        'sizes' => ['One Size'],
                        'category_id' => $category->id,
                        'quantity' => 5,
                    ],
                ],
            ],
            [
                'name' => 'Yoga Life',
                'email' => 'info@yogalife.com',
                'phone' => '555-5678',
                'address' => '456 Oak St, Anytown USA',
                'products' => [
                    [
                        'name' => 'Yoga Mat',
                        'description' => 'Practice your poses with our durable yoga mat.',
                        'price' => 79.99,
                        'image_url' => 'https://via.placeholder.com/400x400',
                        'sizes' => ['S', 'L'],
                        'category_id' => $category->id,
                        'quantity' => 9,
                    ],
                    [
                        'name' => 'Yoga Blocks',
                        'description' => 'Support your practice with our high-quality yoga blocks.',
                        'price' => 39.99,
                        'image_url' => 'https://via.placeholder.com/400x400',
                        'sizes' => ['One Size'],
                        'category_id' => $category->id,
                        'quantity' => 4,
                    ],
                ],
            ],
        ];

        foreach ($vendors as $vendorData) {
            // Create the vendor
            $vendor = new Vendor();
            $vendor->name = $vendorData['name'];
            $vendor->email = $vendorData['email'];
            $vendor->phone = $vendorData['phone'];
            $vendor->address = $vendorData['address'];
            $vendor->save();

            // Add products for the vendor
            foreach ($vendorData['products'] as $productData) {

                $vendor->products()->create([
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'image_url' => $productData['image_url'],
                    'sizes' => $productData['sizes'],
                    'category_id' => $productData['category_id'],
                    'quantity' => $productData['quantity'],
                ]);
            }
        }
    }
}

